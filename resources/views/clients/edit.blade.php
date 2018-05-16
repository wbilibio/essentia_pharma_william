@extends('master')

@section('title', 'Editar Cliente')

@section('content')
<div class="page-header">
    <h2>Editar Cliente</h2>
</div>
<form class="form-horizontal" action="{{ route('clients.{id}.update', array($item->id)) }}" method="post" enctype="multipart/form-data">
    {!! csrf_field() !!}
    <fieldset>
            <div class="form-group">
                <label class="col-md-2 control-label" for="title">Nome:</label>
                <div class="col-md-12">
                    <input type="text" name="name" class="form-control" id="title" value="{{ empty($item->name) ? old('name') : $item->name }}" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-12 control-label" for="email">Email:</label>
                <div class="col-md-12">
                    <textarea name="email" class="form-control" id="email">{{ empty($item->email) ? old('email') : $item->email }}</textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-12 control-label" for="phone">Telefone:</label>
                <div class="col-md-12">
                    <input type="text" name="phone" class="form-control" id="phone" value="{{ empty($item->phone) ? old('phone') : $item->phone }}" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-12 control-label" for="fileInput">Imagem:</label>
                <div class="col-md-6 pull-left">
                    <input id="fileInput" name="img_file" class="input-file" type="file" {{ empty($item->id) ? 'required' : '' }} />
                    <p class="help-block">(*.png *.jpg *.gif)
                        @if (!empty($item->id))
                            (<a href="{{ asset('_files/clients/' . $item->image) }}" title="ver imagem atual" target="_blank">Ver Imagem Atual</a>)
                        @endif
                    </p>
                </div>
                <div class="col-md-1 pull-right"><a href="{{ route('clients.{id}.remove_image', array($item->id)) }}" class="btn button btn-danger delete-btn pull-right" title="Remover"><div class="title">Deletar Imagem</div><i class="fa fa-trash-o"></i></a></div>

            </div>
            <div class="clearfix"></div>
            <div class="form-group">
                <div class="col-md-12">
                    <a href="{{ route('clients.index') }}" class="btn button btn-default">Voltar</a>
                    <button class="btn button btn-green right-out" type="submit">Salvar</button>
                </div>
            </div>
    </fieldset>
</form>
@endsection
