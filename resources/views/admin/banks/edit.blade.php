@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <h4>Editando banco</h4>
            {!! Form::model($bank,[
                'route' => ['admin.banks.update','bank' => $bank->id],
                'method' => 'PUT'
                ]) !!}

            @include('admin.banks._form')

            <div class="row">
                {!! Form::submit('Salvar banco',['class' => 'btn waves-effect right']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>
@endsection