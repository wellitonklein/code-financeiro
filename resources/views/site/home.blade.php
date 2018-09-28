@extends('layouts.site')

@section('content')
<div class="container">
    <div class="row">
        <div class="col s12 center-align">
            <h1>
                <strong>Fácil Financeiro</strong>
                <span> é uma excelente aplicação para controle financeiro</span>
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <div class="row card z-depth-5">
                <div class="card-content white-text center-align blue-grey">
                    <span class="card-title">Empresarial</span>
                    <p>
                        <span>R$ 25,00/mês</span>
                    </p>
                </div>
                <div class="card-content maiin-content white center-align">
                    {{--<p>--}}
                        {{--<span>R$ 25,00/mês</span>--}}
                    {{--</p>--}}
                    <ul class="collection" id="plan-business">
                        <li class="collection-item">Contas a pagar</li>
                        <li class="collection-item">Contas a receber</li>
                        <li class="collection-item">Contas bancárias</li>
                        <li class="collection-item">Extrato</li>
                        <li class="collection-item">Fluxo de Caixa Anual</li>
                        <li class="collection-item">Gráfico de Fluxo de Caixa Mensal</li>
                        <li class="collection-item">Notificação de saldo em tempo real</li>
                        <li class="collection-item">Filtros personalizados por período</li>
                    </ul>
                </div>
                <div class="card-action white center-align">
                    <a href="{{ route('site.subscriptions.create') }}" class="btn btn-large waves-effect waves-light blue-grey darken-2">
                        Contratar
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
