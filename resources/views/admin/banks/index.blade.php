@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <h4>Listagem de bancos</h4>
            <a href="{{route('admin.banks.create')}}" class="btn waves-effect">Novo banco</a>
            <table class="bordered striped highlight centered responsive-table z-depth-5">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach($banks as $bank)
                    <tr>
                        <td>{{ $bank->id }}</td>
                        <td>{{ $bank->name }}</td>
                        <td>
                            <a href="{{ route('admin.banks.edit',['bank' => $bank->id]) }}">Editar</a> |
                            <delete-action action="{{ route('admin.banks.destroy',['bank' => $bank->id]) }}"
                                           action-element="link-delete-{{$bank->id}}"
                                           csrf-token="{{ csrf_token() }}">
                                <a id="link-delete-{{$bank->id}}"
                                   href="{{ route('admin.banks.destroy',['bank' => $bank->id]) }}">
                                    Excluir
                                </a>
                            </delete-action>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {!! $banks->links() !!}
        </div>
    </div>
@endsection