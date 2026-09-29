<?php

namespace App\Http\Controllers;

use App\Models\Adocao;
use App\Models\Animal;

class RelatorioController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | MÉTRICAS DOS ANIMAIS
        |--------------------------------------------------------------------------
        */

        $totalAnimais = Animal::count();

        $animaisDisponiveis = Animal::where(
            'status',
            'DISPONIVEL'
        )->count();

        $animaisAdotados = Animal::where(
            'status',
            'ADOTADO'
        )->count();

        /*
        |--------------------------------------------------------------------------
        | MÉTRICAS DAS SOLICITAÇÕES
        |--------------------------------------------------------------------------
        */

        $totalSolicitacoes = Adocao::count();

        $solicitacoesPendentes = Adocao::where(
            'status',
            'PENDENTE'
        )->count();

        $solicitacoesAprovadas = Adocao::where(
            'status',
            'APROVADA'
        )->count();

        $solicitacoesRecusadas = Adocao::where(
            'status',
            'RECUSADA'
        )->count();

        $solicitacoesCanceladas = Adocao::where(
            'status',
            'CANCELADA'
        )->count();

        /*
        |--------------------------------------------------------------------------
        | TAXA DE APROVAÇÃO
        |--------------------------------------------------------------------------
        |
        | Considera apenas solicitações que tiveram uma decisão.
        |
        | Taxa = aprovadas / (aprovadas + recusadas) * 100
        |
        */

        $solicitacoesFinalizadas =
            $solicitacoesAprovadas +
            $solicitacoesRecusadas;

        $taxaAprovacao = $solicitacoesFinalizadas > 0
            ? ($solicitacoesAprovadas / $solicitacoesFinalizadas) * 100
            : 0;

        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'relatorios.index',
            compact(
                'totalAnimais',
                'animaisDisponiveis',
                'animaisAdotados',
                'totalSolicitacoes',
                'solicitacoesPendentes',
                'solicitacoesAprovadas',
                'solicitacoesRecusadas',
                'solicitacoesCanceladas',
                'taxaAprovacao'
            )
        );
    }
}