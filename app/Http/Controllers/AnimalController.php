<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnimalRequest;
use App\Http\Requests\UpdateAnimalRequest;

use App\Models\Animal;
use App\Models\Especie;
use App\Models\Raca;
use App\Models\AnimalFoto;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use Cloudinary\Cloudinary;

class AnimalController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | CATÁLOGO / MEUS ANIMAIS
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $query = Animal::with([
            'raca',
            'especie',
            'fotoPrincipal'
        ])
        ->where('user_id', Auth::id());

        /*
        |--------------------------------------------------------------------------
        | FILTROS
        |--------------------------------------------------------------------------
        */

        if ($request->filled('especie_id')) {

            $query->where(
                'especie_id',
                $request->especie_id
            );
        }

        if ($request->filled('raca_id')) {

            $query->where(
                'raca_id',
                $request->raca_id
            );
        }

        if ($request->filled('status')) {

            $query->where(
                'status',
                $request->status
            );
        }

        $animais = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $especies = Especie::orderBy('nome')
            ->get();

        $racas = Raca::with('especie')
            ->orderBy('nome')
            ->get();

        return view('animais.index', compact(
            'animais',
            'especies',
            'racas'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | FORM CREATE
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $especies = Especie::orderBy('nome')
            ->get();

        $racas = Raca::with('especie')
            ->orderBy('nome')
            ->get();

        return view('animais.create', compact(
            'especies',
            'racas'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store(StoreAnimalRequest $request)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDAÇÃO DE INTEGRIDADE
        |--------------------------------------------------------------------------
        */

        $raca = Raca::findOrFail(
            $request->raca_id
        );

        if (
            $raca->especie_id !=
            $request->especie_id
        ) {

            return back()
                ->withInput()
                ->withErrors([
                    'raca_id' =>
                        'A raça selecionada não pertence à espécie informada.'
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | TRANSAÇÃO
        |--------------------------------------------------------------------------
        */

        DB::beginTransaction();

        try {

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

            $dados['user_id'] = Auth::id();

            $dados['status'] = 'DISPONIVEL';

            $dados['castrado'] =
                $request->boolean('castrado');

            $dados['vacinado'] =
                $request->boolean('vacinado');

            /*
            |--------------------------------------------------------------------------
            | REMOVE FOTOS DOS DADOS PRINCIPAIS
            |--------------------------------------------------------------------------
            */

            unset($dados['fotos']);

            /*
            |--------------------------------------------------------------------------
            | CRIA ANIMAL
            |--------------------------------------------------------------------------
            */

            $animal = Animal::create($dados);

            /*
            |--------------------------------------------------------------------------
            | UPLOAD DAS FOTOS
            |--------------------------------------------------------------------------
            */

            if ($request->hasFile('fotos')) {

                $cloudinary = new Cloudinary(env('CLOUDINARY_URL'));

                foreach ($request->file('fotos') as $index => $foto) {

                    $upload = $cloudinary->uploadApi()->upload(
                        $foto->getRealPath(),
                        [
                            'folder' => 'miaudot/animais'
                        ]
                    );

                    $caminho = $upload['secure_url'];

                    AnimalFoto::create([

                        'animal_id' => $animal->id,

                        'caminho' => $caminho,

                        'principal' => $index === 0
                    ]);
                }
            }

            /*
            |--------------------------------------------------------------------------
            | COMMIT
            |--------------------------------------------------------------------------
            */

            DB::commit();

            return redirect()
                ->route('animais.index')
                ->with(
                    'success',
                    'Animal cadastrado com sucesso!'
                );

        } catch (\Exception $e) {

            DB::rollBack();

            /*
            |--------------------------------------------------------------------------
            | REMOVE ARQUIVOS PARCIAIS
            |--------------------------------------------------------------------------
            */

            

            return back()
                ->withInput()
                ->withErrors([
                    'erro' =>
                        'Erro ao cadastrar o animal.'
                ]);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit(string $id)
    {
        $animal = Animal::with('fotos')
            ->findOrFail($id);

        $this->authorize('update', $animal);

        $especies = Especie::orderBy('nome')
            ->get();

        $racas = Raca::with('especie')
            ->orderBy('nome')
            ->get();

        return view('animais.edit', compact(
            'animal',
            'especies',
            'racas'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(
    UpdateAnimalRequest $request,
    string $id
) {
    $animal = Animal::findOrFail($id);

    $this->authorize('update', $animal);

    /*
    |--------------------------------------------------------------------------
    | VALIDAÇÃO DE INTEGRIDADE
    |--------------------------------------------------------------------------
    */

    $raca = Raca::findOrFail(
        $request->raca_id
    );

    if (
        $raca->especie_id !=
        $request->especie_id
    ) {
        return back()
            ->withInput()
            ->withErrors([
                'raca_id' =>
                    'A raça selecionada não pertence à espécie informada.'
            ]);
    }

    /*
    |--------------------------------------------------------------------------
    | DADOS VALIDADOS
    |--------------------------------------------------------------------------
    */

    $dados = $request->validated();

    // Separa as fotos dos demais dados do animal.
    $fotos = $dados['fotos'] ?? [];

    unset($dados['fotos']);

    /*
    |--------------------------------------------------------------------------
    | CAMPOS BOOLEANOS
    |--------------------------------------------------------------------------
    */

    $dados['castrado'] =
        $request->boolean('castrado');

    $dados['vacinado'] =
        $request->boolean('vacinado');

    /*
    |--------------------------------------------------------------------------
    | ATUALIZAÇÃO DOS DADOS DO ANIMAL
    |--------------------------------------------------------------------------
    */

    $animal->update($dados);

    /*
    |--------------------------------------------------------------------------
    | ENVIO DAS NOVAS FOTOS
    |--------------------------------------------------------------------------
    */

    if ($request->hasFile('fotos')) {

        // Verifica se o animal já possui uma foto principal.
        $possuiFotoPrincipal =
            $animal->fotoPrincipal()->exists();

        // Inicializa o Cloudinary.
        $cloudinary = new Cloudinary(
            env('CLOUDINARY_URL')
        );

        foreach ($fotos as $index => $foto) {

            // Ignora arquivos inválidos.
            if (
                !$foto ||
                !$foto->isValid()
            ) {
                continue;
            }

            // Envia a imagem para o Cloudinary.
            $upload = $cloudinary
                ->uploadApi()
                ->upload(
                    $foto->getRealPath(),
                    [
                        'folder' => 'miaudot/animais'
                    ]
                );

            // Obtém a URL segura da imagem.
            $caminho = $upload['secure_url'];

            /*
            |--------------------------------------------------------------------------
            | DEFINIÇÃO DA FOTO PRINCIPAL
            |--------------------------------------------------------------------------
            */

            $principal = false;

            if (
                !$possuiFotoPrincipal &&
                $index === 0
            ) {
                $principal = true;

                $possuiFotoPrincipal = true;
            }

            /*
            |--------------------------------------------------------------------------
            | REGISTRO DA FOTO NO BANCO DE DADOS
            |--------------------------------------------------------------------------
            */

            AnimalFoto::create([
                'animal_id' => $animal->id,
                'caminho' => $caminho,
                'principal' => $principal
            ]);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | REDIRECIONAMENTO
    |--------------------------------------------------------------------------
    */

    return redirect()
        ->route('animais.index')
        ->with(
            'success',
            'Animal atualizado com sucesso!'
        );
}

    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    */

    public function show(string $id)
    {
        $animal = Animal::with([
            'user',
            'raca',
            'especie',
            'fotos',
            'fotoPrincipal'
        ])->findOrFail($id);

        return view('animais.show', compact(
            'animal'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | DESTROY
    |--------------------------------------------------------------------------
    */

    public function destroy(string $id)
    {
        $animal = Animal::findOrFail($id);

        $this->authorize('delete', $animal);

        $animal->delete();

        return redirect()
            ->route('animais.index')
            ->with(
                'success',
                'Animal removido com sucesso!'
            );
    }

    public function racasPorEspecie($especieId)
    {
        $racas = Raca::where(
                'especie_id',
                $especieId
            )
            ->orderBy('nome')
            ->get();

        return response()->json($racas);
    }
}