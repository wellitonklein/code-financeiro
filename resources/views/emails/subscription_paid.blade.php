<h3>{{ config('app.name') }}</h3>
<p>Olá {{$user->name}}!</p>
<p>Parabéns, sua assinatura na plataforma já está ativa.</p>
<p>
    Data de expiração:
    <strong>{{(new \Carbon\Carbon($subscription->expires_at))->format('d/m/Y')}}</strong>
</p>
<p>
    Clique <a target="_blank" href="{{url('/')."/app/#!/login"}}">aqui</a> para acessar a plataforma financeira.
    Informe suas credenciais cadastradas quando o usuário foi registrado para entrar na plataforma.
</p>
<p>
    Quando chegar na data de expiração, sua assinatura será renovada automaticamente, caso pagamento tenha feito com cartão de crédito.
    Se o pagamento foi com boleto, um novo boleto será gerado nesta data para pagamento.
</p>
<p>Obs.: Não responda este e-mail, ele é gerado automaticamente</p>