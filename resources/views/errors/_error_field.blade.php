@if($errors->any())
    <ul class="collection">
        <li class="collection-item red white-text"><h6><strong>Foram encontrado os seguintes erros</strong></h6></li>
        @foreach($errors->all() as $error)
            <li class="collection-item red white-text">{{ $error }}</li>
        @endforeach
    </ul>
@endif