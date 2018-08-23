@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <h4>Novo banco</h4>
            {!! Form::open(['route' => 'admin.banks.store', 'files' => true]) !!}

            @include('admin.banks._form')

            {!! Form::close() !!}
        </div>
    </div>
@endsection