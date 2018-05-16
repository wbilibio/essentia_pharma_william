@extends('master')

@section('title', 'Clientes')

@section('content')
    <div class="page-header">
        <h2>Nossos Clientes</h2>
    </div>
    <div class="row list-clients">
        <div class="col-md-8 col-xs-12">
            <h5>Lista de clientes</h5>
            @if(count($items) == 0)
                <h5 class="text-center">Nenhum item cadastrado.</h5>
            @else
                <table class="table-list table-h">
                    <thead>
                    <tr>
                        <th>Imagem</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Telefone</th>
                        <th class="center" width="200">Ações</th>
                    </tr>
                    </thead>
                    <tbody class="sortable">
                    {!! csrf_field() !!}
                    @foreach($items as $item)
                        <tr class="ui-state-default" data-id="{{ $item->id }}">
                            <td>
                                <div class="thumb-img">
                                    @if(!empty($item->image))
                                        <img src="{{ asset('_files/clients/' . $item->image) }}" alt="{{ $item->image }}" title="{{ $item->image }}">
                                    @else
                                        <img src="{{ asset('images/sem-foto.jpg') }}" alt="sem foto" title="sem foto">
                                    @endif
                                </div>
                            </td>
                            <td>
                                <h6>{{ $item->name }}</h6>
                            </td>
                            <td>
                                <h6>{{ $item->email }}</h6>
                            </td>
                            <td>
                                <h6>{{ $item->phone }}</h6>
                            </td>
                            <td class="right" width="200">
                                <a href="{{ route('clients.{id}.edit', array($item->id)) }}" class="btn button btn-success" title="Editar"><div class="title">Editar</div><i class="fa fa-pencil"></i></a>
                                <a href="{{ route('clients.{id}.destroy', array($item->id)) }}" class="btn button btn-danger delete-btn" title="Remover"><div class="title">Deletar</div><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
        <div class="col-md-4 col-xs-12">
            <h5>Cadastrar cliente</h5>
            <form class="form-horizontal" action="{{ route('clients.store') }}" method="post" enctype="multipart/form-data">
                {!! csrf_field() !!}
                <fieldset>
                    <div class="form-group">
                        <label class="control-label" for="title">Nome:</label>
                        <div>
                            <input type="text" name="name" class="form-control" id="name" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="description">E-mail:</label>
                        <div>
                            <input type="email" name="email" class="form-control" id="email" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="phone">Telefone:</label>
                        <div>
                            <input type="text" class="phone form-control" name="phone" id="phone" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="fileInput">Imagem:</label>
                        <div class="col-md-5">
                            <input id="fileInput" name="img_file" class="input-file" type="file" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="submit">
                            <button class="btn button btn-green pull-right" type="submit">Salvar</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
@endsection