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
                                <?php $modalId = "modal-delete-$bank->id";?>
                                <a id="link-modal-{{$bank->id}}"
                                   href="#{{$modalId}}">
                                    Excluir
                                </a>
                                <modal :modal="{{ json_encode(['id' => $modalId])}}" style="display: none">
                                    <div slot="content">
                                        <h5>Mensagem de confirmação!</h5>
                                        <p><strong>Deseja excluir este banco?</strong></p>
                                        <div class="divider"></div>
                                        <p>Nome: <strong>{{ $bank->name }}</strong></p>
                                        <div class="divider"></div>
                                    </div>
                                    <div slot="footer">
                                        <button class="btn waves-effect lighten-2 modal-close modal-action"
                                                id="link-delete-{{$bank->id}}">OK</button>
                                        <button class="btn btn-flat waves-effect waves-red modal-close modal-action">Cancelar</button>
                                    </div>
                                </modal>
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