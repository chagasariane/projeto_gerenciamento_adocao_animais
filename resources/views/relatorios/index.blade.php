@extends('layouts.app')

@section('content')

<section class="relatorios-page">

    <div class="container">

        {{-- HEADER --}}
        <div class="mb-5">

            <h1 class="section-title mb-2">
                Relatórios e Estatísticas
            </h1>

            <p class="crud-description m-0">
                Visão geral dos animais e processos de adoção
                cadastrados na plataforma.
            </p>

        </div>


        {{-- ANIMAIS --}}
        <div class="mb-5">

            <h2 class="report-section-title mb-4">
                Animais
            </h2>

            <div class="row g-4">

                <div class="col-md-4">

                    <div class="report-card">

                        <span class="report-label">
                            Animais cadastrados
                        </span>

                        <strong class="report-number">
                            {{ $totalAnimais }}
                        </strong>

                    </div>

                </div>


                <div class="col-md-4">

                    <div class="report-card">

                        <span class="report-label">
                            Animais disponíveis
                        </span>

                        <strong class="report-number">
                            {{ $animaisDisponiveis }}
                        </strong>

                    </div>

                </div>


                <div class="col-md-4">

                    <div class="report-card">

                        <span class="report-label">
                            Animais adotados
                        </span>

                        <strong class="report-number">
                            {{ $animaisAdotados }}
                        </strong>

                    </div>

                </div>

            </div>

        </div>


        {{-- SOLICITAÇÕES --}}
        <div class="mb-5">

            <h2 class="report-section-title mb-4">
                Solicitações de adoção
            </h2>

            <div class="row g-4">

                <div class="col-md-4 col-lg-3">

                    <div class="report-card">

                        <span class="report-label">
                            Total
                        </span>

                        <strong class="report-number">
                            {{ $totalSolicitacoes }}
                        </strong>

                    </div>

                </div>


                <div class="col-md-4 col-lg-3">

                    <div class="report-card">

                        <span class="report-label">
                            Pendentes
                        </span>

                        <strong class="report-number">
                            {{ $solicitacoesPendentes }}
                        </strong>

                    </div>

                </div>


                <div class="col-md-4 col-lg-3">

                    <div class="report-card">

                        <span class="report-label">
                            Aprovadas
                        </span>

                        <strong class="report-number">
                            {{ $solicitacoesAprovadas }}
                        </strong>

                    </div>

                </div>


                <div class="col-md-4 col-lg-3">

                    <div class="report-card">

                        <span class="report-label">
                            Recusadas
                        </span>

                        <strong class="report-number">
                            {{ $solicitacoesRecusadas }}
                        </strong>

                    </div>

                </div>


                <div class="col-md-4 col-lg-3">

                    <div class="report-card">

                        <span class="report-label">
                            Canceladas
                        </span>

                        <strong class="report-number">
                            {{ $solicitacoesCanceladas }}
                        </strong>

                    </div>

                </div>

            </div>

        </div>


        {{-- TAXA DE APROVAÇÃO --}}
        <div class="mb-5">

            <h2 class="report-section-title mb-4">
                Indicadores
            </h2>

            <div class="report-highlight-card">

                <div>

                    <span class="report-label">
                        Taxa de aprovação
                    </span>

                    <p class="report-description mb-0">
                        Percentual de solicitações aprovadas entre
                        as solicitações que já receberam uma decisão.
                    </p>

                </div>

                <strong class="report-percentage">

                    {{ number_format(
                        $taxaAprovacao,
                        1,
                        ',',
                        '.'
                    ) }}%

                </strong>

            </div>

        </div>

    </div>

</section>

@endsection