@extends('adminlte::page')

@section('title', 'Cadastro de Produtos')

@section('content_header')
    <script src="{{url('/js/jquery.mask.min.js')}}"></script>
    
    <div class='col-sm-11'>
@if ($acao == 1)
    <h2> Inclusão de Produtos </h2>
@else 
    <h2> Alteração de Produtos </h2>
@endif
</div>
<div class='col-sm-1'>
    <a href='{{route('produtos.index')}}' class='btn btn-primary' 
       role='button'> Voltar </a>
</div>

<div class="col-sm-12">
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif    
</div>

<div class='col-sm-12'>
@if ($acao == 1)
    <form method="post" action="{{route('produtos.store')}}">
@else 
      <form method="post" action="{{route('produtos.update', $reg->id)}}">
        {!! method_field('put') !!}
@endif
        {{ csrf_field() }}
        <div class="form-group">
            <label for="tipo">Tipo:</label>
            <select class="form-control" id="tipo" name="tipo">
                <option value="Doce" 
@if ((isset($reg) && $reg->tipo=="Doce") 
     or old('tipo') == "Doce") selected @endif>
                        Doce</option>
                <option value="Torta"
@if ((isset($reg) && $reg->tipo=="Torta") 
     or old('tipo') == "Torta") selected @endif>                        
                        Torta</option>
                <option value="Pavê"
@if ((isset($reg) && $reg->tipo=="Pave") 
     or old('tipo') == "Pave") selected @endif>
                        Pave</option>
           </select>
        </div>


        <div class="form-group">
            <label for="cor">Nome:</label>
            <input type="text" class="form-control" id="nome" 
                   name="nome" 
                   value="{{$reg->nome or old('nome')}}"
                   required>
        </div>

       
        <div class="form-group">
            <label for="preco">Preço R$:</label>
            <input type="text" class="form-control" id="preco" 
                   name="preco" 
                   value="{{$reg->preco or old('preco')}}"                   
                   required>
        </div>

        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <input type="text" class="form-control" id="descricao"
                   name="descricao"
                   value="{{$reg->descricao or old('descricao')}}"
                   required>
        </div>
          <div class="form-group">
              <label for="usuarios_id">Cadastrado por:</label>
              <select id="usuarios_id" name="usuarios_id" class="form-control">
                  @foreach($usuarios as $u) {
                  <option value="{{$u->id}}" {{ isset($reg) and $reg->usuarios_id == $u->id or old('usuarios_id') == $u->id ? "selected" : "" }}>{{$u->nome}}</option>
                  @endforeach
                  }
              </select>
          </div>


          <button type="submit" class="btn btn-primary">Enviar</button>
    </form>  

</div>

<script>
$(document).ready(function() {
   $('#preco').mask("##.###.##0,00", {reverse: true}); 
});    
</script>

@endsection