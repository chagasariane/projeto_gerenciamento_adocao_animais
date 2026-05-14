<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdocaoRequest;
use App\Http\Requests\UpdateAdocaoRequest;

use App\Models\Adocao;
use App\Models\Animal;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdocaoController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LISTAGEM
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $query = Adocao::with([
            'user',
            'animal.fotoPrincipal',
            'animal.raca',
            'animal.especie'
        ]);

        /*
        |--------------------------------------------------------------------------
        | ADMIN
        |--------------------------------------------------------------------------
        */

        if (!auth()->user()->is_admin) {

            $query->where(function ($query) {

                $query->where('user_id', auth()->id())

                    ->orWhereHas('animal', function ($subQuery) {

                        $subQuery->where('user_id', auth()->id());

                    });

            });
        }

        $adocoes = $query
            ->latest()
            ->paginate(10);

        return view('adocoes.index', compact(
            'adocoes'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | FORM CREATE
    |--------------------------------------------------------------------------
    */

    public function create(Request $request)
    {
        $animal = Animal::with([
            'fotoPrincipal',
            'raca',
            'especie'
        ])
        ->where('status', 'DISPONIVEL')
        ->findOrFail($request->animal_id);

        /*
        |--------------------------------------------------------------------------
        | IMPEDIR PRÓPRIO DONO
        |--------------------------------------------------------------------------
        */

        if ($animal->user_id == auth()->id()) {

            return redirect()
                ->route('animais.show', $animal->id)
                ->withErrors([
                    'animal' => 'Você não pode solicitar adoção do próprio animal.'
                ]);
        }

        return view('adocoes.create', compact(
            'animal'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store(StoreAdocaoRequest $request)
    {
        /*
        |--------------------------------------------------------------------------
        | ANIMAL
        |--------------------------------------------------------------------------
        */

        $animal = Animal::findOrFail(
            $request->animal_id
        );

        /*
        |--------------------------------------------------------------------------
        | ANIMAL DISPONÍVEL
        |--------------------------------------------------------------------------
        */

        if ($animal->status != 'DISPONIVEL') {

            return back()
                ->withErrors([
                    'animal' =>
                        'Este animal não está disponível para adoção.'
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | NÃO PODE ADOTAR PRÓPRIO ANIMAL
        |--------------------------------------------------------------------------
        */

        if ($animal->user_id == auth()->id()) {

            return back()
                ->withErrors([
                    'animal' =>
                        'Você não pode adotar um animal cadastrado por você.'
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | JÁ POSSUI SOLICITAÇÃO PENDENTE
        |--------------------------------------------------------------------------
        */

        $possuiSolicitacao = Adocao::where(
            'animal_id',
            $animal->id
        )
        ->where(
            'user_id',
            auth()->id()
        )
        ->where(
            'status',
            'PENDENTE'
        )
        ->exists();

        if ($possuiSolicitacao) {

            return back()
                ->withErrors([
                    'adocao' =>
                        'Você já possui uma solicitação pendente para este animal.'
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | DADOS VALIDADOS
        |--------------------------------------------------------------------------
        */

        $dados = $request->validated();

        /*
        |--------------------------------------------------------------------------
        | CAMPOS COMPLEMENTARES
        |--------------------------------------------------------------------------
        */

        $dados['user_id'] = auth()->id();

        $dados['status'] = 'PENDENTE';

        /*
        |--------------------------------------------------------------------------
        | CRIAÇÃO
        |--------------------------------------------------------------------------
        */

        Adocao::create($dados);

        return redirect()
            ->route('adocoes.index')
            ->with(
                'success',
                'Solicitação enviada com sucesso!'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit(string $id)
    {
        $adocao = Adocao::with([
            'user',
            'animal.fotoPrincipal',
            'animal.raca',
            'animal.especie'
        ])->findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | AUTHORIZATION
        |--------------------------------------------------------------------------
        */

        $this->authorize('update', $adocao);

        /*
        |--------------------------------------------------------------------------
        | SOMENTE PENDENTE
        |--------------------------------------------------------------------------
        */

        if ($adocao->status != 'PENDENTE') {

            return redirect()
                ->route('adocoes.index')
                ->withErrors([
                    'adocao' =>
                        'Somente solicitações pendentes podem ser gerenciadas.'
                ]);
        }

        return view('adocoes.edit', compact(
            'adocao'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(
        UpdateAdocaoRequest $request,
        string $id
    ) {
        $adocao = Adocao::with('animal')
            ->findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | AUTHORIZATION
        |--------------------------------------------------------------------------
        */

        $this->authorize('update', $adocao);

        /*
        |--------------------------------------------------------------------------
        | SOMENTE PENDENTE
        |--------------------------------------------------------------------------
        */

        if ($adocao->status != 'PENDENTE') {

            return redirect()
                ->route('adocoes.index')
                ->withErrors([
                    'adocao' =>
                        'Esta solicitação já foi finalizada.'
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | DADOS VALIDADOS
        |--------------------------------------------------------------------------
        */

        $dados = $request->validated();

        /*
        |--------------------------------------------------------------------------
        | PROCESSO TRANSACIONAL
        |--------------------------------------------------------------------------
        */

        DB::transaction(function () use (
            $dados,
            $adocao
        ) {

            /*
            |--------------------------------------------------------------------------
            | APROVAÇÃO
            |--------------------------------------------------------------------------
            */

            if ($dados['status'] == 'APROVADA') {

                $adocao->update([

                    'status' => 'APROVADA',

                    'data_aprovacao' => now(),
                ]);

                /*
                |--------------------------------------------------------------------------
                | ANIMAL ADOTADO
                |--------------------------------------------------------------------------
                */

                $adocao->animal->update([

                    'status' => 'ADOTADO'
                ]);

                /*
                |--------------------------------------------------------------------------
                | RECUSA OUTRAS
                |--------------------------------------------------------------------------
                */

                Adocao::where(
                    'animal_id',
                    $adocao->animal_id
                )
                ->where('id', '!=', $adocao->id)
                ->where('status', 'PENDENTE')
                ->update([
                    'status' => 'RECUSADA'
                ]);

            } else {

                /*
                |--------------------------------------------------------------------------
                | RECUSA
                |--------------------------------------------------------------------------
                */

                $adocao->update([

                    'status' => 'RECUSADA'
                ]);
            }
        });

        return redirect()
            ->route('adocoes.index')
            ->with(
                'success',
                'Solicitação atualizada com sucesso!'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | CANCELAMENTO
    |--------------------------------------------------------------------------
    */

    public function destroy(string $id)
    {
        $adocao = Adocao::findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | AUTHORIZATION
        |--------------------------------------------------------------------------
        */

        $this->authorize('delete', $adocao);

        /*
        |--------------------------------------------------------------------------
        | SOMENTE PENDENTE
        |--------------------------------------------------------------------------
        */

        if ($adocao->status != 'PENDENTE') {

            return back()
                ->withErrors([
                    'adocao' =>
                        'Somente solicitações pendentes podem ser canceladas.'
                ]);
        }

        $adocao->update([

            'status' => 'CANCELADA'
        ]);

        return redirect()
            ->route('adocoes.index')
            ->with(
                'success',
                'Solicitação cancelada com sucesso!'
            );
    }
}