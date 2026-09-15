<?php

namespace App\Http\Controllers;

use App\Models\Conversa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Animal;

class ChatController extends Controller
{
    /**
     * Exibe todas as conversas do usuário logado.
     */
    public function index()
    {
        /** @var User $usuario */
        $usuario = Auth::user();

        $conversas = Conversa::where('usuario_1_id', $usuario->id)
            ->orWhere('usuario_2_id', $usuario->id)
            ->with(['usuario1', 'usuario2'])
            ->latest()
            ->get();

        return view('chat.index', compact('conversas'));
    }

    /**
     * Exibe as mensagens de uma conversa.
     */
    public function show(Conversa $conversa)
    {
        /** @var User $usuario */
        $usuario = Auth::user();

        // Verifica se o usuário faz parte dessa conversa
        if (
            $conversa->usuario_1_id !== $usuario->id &&
            $conversa->usuario_2_id !== $usuario->id
        ) {
            abort(403);
        }

        $mensagens = $conversa->mensagens()
            ->with('usuario')
            ->orderBy('created_at')
            ->get();

        // Identifica o outro usuário da conversa
        $outroUsuario = $conversa->usuario_1_id === $usuario->id
            ? $conversa->usuario2
            : $conversa->usuario1;

        // Marca como lidas as mensagens enviadas pelo outro usuário
        $conversa->mensagens()
            ->where('usuario_id', '!=', $usuario->id)
            ->where('lida', false)
            ->update(['lida' => true]);

        return view('chat.show', compact(
            'conversa',
            'mensagens',
            'outroUsuario'
        ));
    }

    /**
     * Salva uma nova mensagem na conversa.
     */
    public function store(Request $request, Conversa $conversa)
    {
        /** @var User $usuario */
        $usuario = Auth::user();

        // Verifica se o usuário faz parte dessa conversa
        if (
            $conversa->usuario_1_id !== $usuario->id &&
            $conversa->usuario_2_id !== $usuario->id
        ) {
            abort(403);
        }

        // Valida a mensagem
        $request->validate([
            'mensagem' => [
                'required',
                'string',
                'max:5000'
            ],
        ]);

        // Cria a mensagem
        $conversa->mensagens()->create([
            'usuario_id' => $usuario->id,
            'mensagem' => $request->mensagem,
            'lida' => false,
        ]);

        return redirect()->route('chat.show', $conversa);
    }

    
//método iniciar
    public function iniciar(Animal $animal)
    {
        /** @var User $usuario */
        $usuario = Auth::user();

        // Obtém o usuário responsável pelo animal
        $protetor = $animal->user;

        // Verifica se o animal possui um responsável
        if (!$protetor) {
            return redirect()->back()->with(
                'error',
                'Não foi possível encontrar o responsável por este animal.'
            );
        }

        // O responsável não pode iniciar uma conversa consigo mesmo
        if ($usuario->id === $protetor->id) {
            return redirect()->back()->with(
                'error',
                'Você não pode iniciar uma conversa consigo mesmo.'
            );
        }

        // Mantém os usuários sempre na mesma ordem
        $usuario1 = min($usuario->id, $protetor->id);
        $usuario2 = max($usuario->id, $protetor->id);

        // Procura uma conversa existente entre os dois usuários
        $conversa = Conversa::where('usuario_1_id', $usuario1)
            ->where('usuario_2_id', $usuario2)
            ->first();

        // Se não existir, cria uma nova conversa
        if (!$conversa) {
            $conversa = Conversa::create([
                'usuario_1_id' => $usuario1,
                'usuario_2_id' => $usuario2,
            ]);
        }

        return redirect()->route('chat.show', $conversa);
    }  
}