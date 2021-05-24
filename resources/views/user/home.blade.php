@extends('layout.main')

@section('js')
    <script src="{{asset('js/modules/user/home.blade.js')}}"></script>
@endsection

@section('content')
            <div class="row mb-2">
                    <div class="col-6">
                        <h5>USUÁRIOS</h5>
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{route('user.form')}}"
                            class="btn btn-success waves-effect waves-light mb-2" data-animation="fadein">
                            <i class="fa fa-plus-circle mr-1"></i> Novo Usuário
                        </a>
                    </div>
                </div>

                @if(count($items))
                <div class="table-responsive">
                    <table class="table table-centered table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Nascimento</th>
                                <th>Celular</th>
                                <th>Telefone Fixo</th>
                                <th>Endereço</th>
                                <th>Enviado em</th>
                                <th style="width: 150px;" class="text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>{{$item->birthday ? date_format(new DateTime($item->birthday), 'd/m/Y') : ''}}</td>
                                <td>{{$item->phoneMobile->last() ? $item->phoneMobile->last()->number : ''}}</td>
                                <td>{{$item->phone->last() ? $item->phone->last()->number : ''}}</td>
                                <td>{{$item->fullAddress() ? $item->fullAddress() : ''}}</td>
                                <td>{{ date_format($item->created_at, 'd/m/Y H:i:s') }}</td>

                                <td class="text-center">
                                    <a href="{{route('user.edit', $item)}}" type="button" class="btn action-icon text-primary">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a type="button" data-value="{{$item->id}}" class="btn action-icon text-primary delete_user">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @else
                    <div class="alert alert-info" role="alert">
                        <i class="fa fa-exclamation-circle mr-2"></i> Nenhum resultado encontrado!
                    </div>
                @endif
@endsection