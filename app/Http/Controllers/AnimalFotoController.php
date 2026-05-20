<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnimalFotoRequest;

use App\Models\Animal;
use App\Models\AnimalFoto;

use Illuminate\Support\Facades\Storage;

class AnimalFotoController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store(
    StoreAnimalFotoRequest $request,
    string $animalId
) {

    /*
    |----------------------------------------------------------------------
    | ANIMAL
    |----------------------------------------------------------------------
    */

    $animal = Animal::findOrFail($animalId);

    /*
    |----------------------------------------------------------------------
    | AUTHORIZATION
    |----------------------------------------------------------------------
    */

    $this->authorize('update', $animal);

    /*
    |----------------------------------------------------------------------
    | FOTO PRINCIPAL
    |----------------------------------------------------------------------
    */

    $possuiFotoPrincipal =
        $animal->fotoPrincipal()->exists();

    /*
    |----------------------------------------------------------------------
    | UPLOAD
    |----------------------------------------------------------------------
    */

    if ($request->hasFile('fotos')) {

        $fotos = $request->file('fotos');

        foreach ($fotos as $index => $foto) {

            /*
            |--------------------------------------------------------------
            | IGNORA ITENS INVÁLIDOS
            |--------------------------------------------------------------
            */

            if (
                empty($foto) ||
                !$foto->isValid()
            ) {
                continue;
            }

            /*
            |--------------------------------------------------------------
            | SALVA ARQUIVO
            |--------------------------------------------------------------
            */
            
            

            $nomeArquivo = time() . '_' . $foto->getClientOriginalName();

$foto->move(
    public_path('storage/animais'),
    $nomeArquivo
);

$caminho = 'animais/' . $nomeArquivo;

            /*
            |--------------------------------------------------------------
            | DEFINE PRINCIPAL
            |--------------------------------------------------------------
            */

            $principal = false;

            if (
                !$possuiFotoPrincipal &&
                $index === 0
            ) {

                $principal = true;
            }

            /*
            |--------------------------------------------------------------
            | REGISTRO
            |--------------------------------------------------------------
            */

            AnimalFoto::create([

                'animal_id' => $animal->id,

                'caminho' => $caminho,

                'principal' => $principal
            ]);
        }
    }

    return redirect()
        ->route('animais.edit', $animal->id)
        ->with(
            'success',
            'Fotos adicionadas com sucesso!'
        );
}


    /*
    |--------------------------------------------------------------------------
    | REORDENAR
    |--------------------------------------------------------------------------
    */

    public function reordenar(
        \Illuminate\Http\Request $request,
        string $animalId
    ) {

        /*
        |--------------------------------------------------------------------------
        | ANIMAL
        |--------------------------------------------------------------------------
        */

        $animal = Animal::findOrFail($animalId);

        /*
        |--------------------------------------------------------------------------
        | AUTHORIZATION
        |--------------------------------------------------------------------------
        */

        $this->authorize('update', $animal);

        /*
        |--------------------------------------------------------------------------
        | IDS DAS FOTOS
        |--------------------------------------------------------------------------
        */

        $fotosIds = $request->fotos;

        /*
        |--------------------------------------------------------------------------
        | REMOVE PRINCIPAL
        |--------------------------------------------------------------------------
        */

        $animal->fotos()->update([
            'principal' => false
        ]);

        /*
        |--------------------------------------------------------------------------
        | REDEFINE PRINCIPAL
        |--------------------------------------------------------------------------
        */

        foreach ($fotosIds as $index => $fotoId) {

            AnimalFoto::where('id', $fotoId)
                ->where('animal_id', $animal->id)
                ->update([
                    'principal' => $index === 0
                ]);
        }

        return response()->json([
            'success' => true
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | DESTROY
    |--------------------------------------------------------------------------
    */

    public function destroy(string $id)
    {
        /*
        |--------------------------------------------------------------------------
        | FOTO
        |--------------------------------------------------------------------------
        */

        $foto = AnimalFoto::with('animal')
            ->findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | AUTHORIZATION
        |--------------------------------------------------------------------------
        */

        $this->authorize(
            'update',
            $foto->animal
        );

        /*
        |--------------------------------------------------------------------------
        | REMOVE ARQUIVO
        |--------------------------------------------------------------------------
        */

        if (
            Storage::disk('public')
                ->exists($foto->caminho)
        ) {

            Storage::disk('public')
                ->delete($foto->caminho);
        }

        /*
        |--------------------------------------------------------------------------
        | REMOVE REGISTRO
        |--------------------------------------------------------------------------
        */

        $foto->delete();

        /*
        |--------------------------------------------------------------------------
        | REDEFINE FOTO PRINCIPAL
        |--------------------------------------------------------------------------
        */

        if (
            $foto->principal &&
            $foto->animal
                ->fotos()
                ->exists()
        ) {

            $novaPrincipal =
                $foto->animal
                    ->fotos()
                    ->first();

            $novaPrincipal->update([
                'principal' => true
            ]);
        }

        return back()->with(
            'success',
            'Foto removida com sucesso!'
        );
    }
}