@extends('adminlte::page')

@section('title', 'Cadastro de Tipos de Produtos')

@section('content_header')

@if ($acao==1)
<h2>Inclusão de Tipos de Produtos
@else ($acao ==2)
<h2>Alteração de Tipos de Produtos
@endif          

  <a href="{{ route('tipos.index') }}" class="btn btn-primary pull-right" role="button">Voltar</a>
</h2>

@endsection

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if ($acao==1)
<form method="POST" action="{{ route('tipos.store') }}"
      enctype="multipart/form-data">
@else ($acao==2)
<form method="POST" action="{{route('tipos.update', $reg->id)}}"
      enctype="multipart/form-data">
{!! method_field('put') !!}
@endif          
{{ csrf_field() }}

              
  <div class="row">
      <div class="col-sm-6">
      <div class="form-group">
        <label for="nome">Nome</label>
        <input type="text" id="nome" name="nome" autofocus="" required 
               value="{{$reg->nome or old('nome')}}"
               class="form-control">
      </div>
    </div>
    </div>



  <input type="submit" value="Enviar" class="btn btn-success">
  <input type="reset" value="Limpar" class="btn btn-warning">
</form>

@endsection
