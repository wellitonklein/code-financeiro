@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <h4>Editando banco</h4>
            {!! Form::model($bank,[
                'route' => ['admin.banks.update','bank' => $bank->id],
                'method' => 'PUT',
                'files' => true
                ]) !!}

            @include('admin.banks._form')

            {!! Form::close() !!}
        </div>
    </div>
@endsection