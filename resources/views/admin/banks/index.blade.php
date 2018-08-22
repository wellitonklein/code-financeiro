@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <h4>Listagem de bancos</h4>
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
                            Ações
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {!! $banks->links() !!}
        </div>
    </div>
@endsection