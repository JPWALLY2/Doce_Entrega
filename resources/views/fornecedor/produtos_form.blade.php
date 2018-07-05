@extends('adminlte::page')

@section('title', 'Cadastro de Produtos')

@section('content_header')

@if ($acao==1)
<h2>Inclusão de Produtos
@else ($acao ==2)
<h2>Alteração de Produtos
@endif          

  <a href="{{ route('produtosforn.index') }}" class="btn btn-primary pull-right" role="button">Voltar</a>
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
<form method="POST" action="{{ route('produtosforn.store') }}"
      enctype="multipart/form-data">
@else ($acao==2)
<form method="POST" action="{{route('produtosforn.update', $reg->id)}}"
      enctype="multipart/form-data">
{!! method_field('put') !!}
@endif          
{{ csrf_field() }}

<div class="row">
    <div class="col-sm-6">
      <div class="form-group">
        <label for="tipo_id">Tipo</label>
        <select id="tipo_id" name="tipo_id" class="form-control">
          @foreach($tipoforn as $t)
            <option value="{{$t->id}}" 
                    {{((isset($reg) and $reg->tipo_id == $t->id) or 
                       old('tipo_id') == $t->id) ? "selected" : "" }}>
                    {{$t->nome}}</option>
          @endforeach
        </select>  
      </div>
    </div>
    
    <div class="col-sm-6">
        <div class="form-group">
            <label for="preco">Preço R$</label>
            <input type="text" id="preco" name="preco" required 
                   value="{{$reg->preco or old('preco')}}"
                   class="form-control">
        </div>
      </div>
    

  </div>              

  <div class="row">
      <div class="col-sm-6">
      <div class="form-group">
        <label for="nome">Nome</label>
        <input type="text" id="nome" name="nome" required 
               value="{{$reg->nome or old('nome')}}"
               class="form-control">
      </div>
    </div>
      <div class="col-sm-6">
        <div class="form-group">
          <label for="descricao">Descrição</label>
          <input type="text" id="descricao" name="descricao" required 
                 value="{{$reg->descricao or old('descricao')}}"
                 class="form-control">
        </div>
      </div>
      
  </div>
  <input type="hidden" name="us" value="2">

    


  <input type="submit" value="Enviar" class="btn btn-success">
  <input type="reset" value="Limpar" class="btn btn-warning">
</form>

@endsection

@section('js')
<script src="https://code.jquery.com/jquery-latest.min.js"></script>
<script src="/js/jquery.mask.min.js"></script>
<script>
  $(document).ready(function() {
    $('#preco').mask('#.###.##0,00', {reverse: true});
  });
</script>
@endsection