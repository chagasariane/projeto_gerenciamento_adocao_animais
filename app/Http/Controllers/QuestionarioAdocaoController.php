<?php

namespace App\Http\Controllers;

use App\Models\Adocao;
use App\Models\Animal;
use App\Models\PerguntaAdocao;
use App\Models\RespostaAdocao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Notifications\NovaSolicitacaoAdocaoNotification;

class QuestionarioAdocaoController extends Controller
{
    public function create(Animal $animal)
    {
        /*
        |--------------------------------------------------------------------------
        | ANIMAL DISPONÍVEL
        |--------------------------------------------------------------------------
        */

        if ($animal->status !== 'DISPONIVEL') {
            return redirect()
                ->route('animais.show', $animal->id)
                ->withErrors([
                    'animal' =>
                        'Este animal não está disponível para adoção.'
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | NÃO PODE ADOTAR O PRÓPRIO ANIMAL
        |--------------------------------------------------------------------------
        */

        if ($animal->user_id == auth()->id()) {
            return redirect()
                ->route('animais.show', $animal->id)
                ->withErrors([
                    'animal' =>
                        'Você não pode solicitar adoção do próprio animal.'
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | VERIFICAR SOLICITAÇÃO EXISTENTE
        |--------------------------------------------------------------------------
        */

        $possuiSolicitacao = Adocao::where(
            'animal_id',
            $animal->id
        )
            ->where('user_id', auth()->id())
            ->where('status', 'PENDENTE')
            ->exists();

        if ($possuiSolicitacao) {
            return redirect()
                ->route('adocoes.index')
                ->withErrors([
                    'adocao' =>
                        'Você já possui uma solicitação pendente para este animal.'
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | PERGUNTAS
        |--------------------------------------------------------------------------
        */

        $perguntas = PerguntaAdocao::where('ativo', true)
            ->orderBy('ordem')
            ->get();

        return view(
            'adocoes.questionario',
            compact('animal', 'perguntas')
        );
    }

        public function store(Request $request, Animal $animal)
        {
            /**
             *--------------------------------------------------------------------------
            * VERIFICAÇÕES
            *--------------------------------------------------------------------------
            */

            if ($animal->status !== 'DISPONIVEL') {
                return back()->withErrors([
                    'animal' =>
                        'Este animal não está mais disponível para adoção.'
                ]);
            }

            if ($animal->user_id == auth()->id()) {
                return back()->withErrors([
                    'animal' =>
                        'Você não pode adotar seu próprio animal.'
                ]);
            }

            $possuiSolicitacao = Adocao::where(
                'animal_id',
                $animal->id
            )
                ->where('user_id', auth()->id())
                ->where('status', 'PENDENTE')
                ->exists();

            if ($possuiSolicitacao) {
                return redirect()
                    ->route('adocoes.index')
                    ->withErrors([
                        'adocao' =>
                            'Você já possui uma solicitação pendente para este animal.'
                    ]);
            }

            /**
             *--------------------------------------------------------------------------
            * BUSCAR PERGUNTAS
            *--------------------------------------------------------------------------
            */

            $perguntas = PerguntaAdocao::where('ativo', true)
                ->orderBy('ordem')
                ->get();

            /**
             *--------------------------------------------------------------------------
            * VALIDAÇÃO DINÂMICA
            *--------------------------------------------------------------------------
            */

            $regras = [];

            foreach ($perguntas as $pergunta) {

                $campo = 'respostas.' . $pergunta->id;

                if ($pergunta->obrigatoria) {
                    $regras[$campo] = 'required';
                } else {
                    $regras[$campo] = 'nullable';
                }
            }

            $request->validate(
                $regras,
                [
                    'respostas.*.required' =>
                        'Responda todas as perguntas obrigatórias.'
                ]
            );

            /**
             *--------------------------------------------------------------------------
            * CRIAÇÃO DA ADOÇÃO + RESPOSTAS
            *--------------------------------------------------------------------------
            */

            $adocao = DB::transaction(function () use (
                $request,
                $animal,
                $perguntas
            ) {

                $adocao = Adocao::create([
                    'user_id' => auth()->id(),
                    'animal_id' => $animal->id,
                    'status' => 'PENDENTE',
                ]);

                foreach ($perguntas as $pergunta) {

                    RespostaAdocao::create([
                        'adocao_id' => $adocao->id,
                        'pergunta_id' => $pergunta->id,
                        'pergunta' => $pergunta->pergunta,
                        'resposta' =>
                            $request->input(
                                'respostas.' . $pergunta->id
                            ),
                    ]);
                }

                return $adocao;
            });

            /**
             *--------------------------------------------------------------------------
            * NOTIFICA O RESPONSÁVEL PELO ANIMAL
            *--------------------------------------------------------------------------
            */

            $adocao->load([
                'user',
                'animal.user'
            ]);

            $protetor = $adocao->animal->user;

            if ($protetor) {

                $protetor->notify(
                    new NovaSolicitacaoAdocaoNotification(
                        $adocao
                    )
                );
            }

            /**
             *--------------------------------------------------------------------------
            * REDIRECIONAMENTO
            *--------------------------------------------------------------------------
            */

            return redirect()
                ->route('adocoes.index')
                ->with(
                    'success',
                    'Solicitação de adoção enviada com sucesso!'
                );
        }
}