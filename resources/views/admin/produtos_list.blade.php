@extends('adminlte::page')

@section('title', 'Cadastro de Produtos')

@section('content_header')
        <div class="col-sm-4">
     <form method="POST"
           class="form-inline" 
           action="{{ route('produtos.pesq') }}">
       {{ csrf_field() }}
       <input type="text" class="form-control" 
              name="palavra"
              placeholder="Nome do produto">
       <input type="submit" class="btn btn-success"
              value="Ok">       
         
      <a href="{{ route('produtos.index') }}" 
         class="btn btn-warning" role="button">
          Todos</a>      
     </form>
        </div>
    <h1>
    <a href="{{ route('produtos.create') }}" 
       class="btn btn-primary pull-right" role="button">Novo</a>
    </h1>
@endsection

@section('content')

@if (session('status'))
<div class="alert" style="font-size: larger; color: white; background-color: tan">
      {{ session('status') }}
    </div>  
@endif

<table class="table table-striped">
  <tr>
    <th> Tipo </th>
    <th> Nome </th>
    <th> Descrição </th>
    <th> Preço R$ </th>
    <th> Estoque </th>
    <th> Cadastrado por: </th>
    <th> Data </th>
    <th> Foto </th>    
    <th> Ações </th>
  </tr>  
@forelse($produtos as $p)
  <tr>
    <td> {{$p->tipo->nome}} </td>
    <td> {{$p->nome}} </td>
    <td> {{$p->descricao}} </td>
    <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{number_format($p->preco, 2, ',', '.')}} </td>
    <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{$p->estoque}} </td>
    <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{$p->user->name}} </td>
    <td> {{date_format($p->created_at, 'd/m/Y')}} </td>
    <td>
      @if (Storage::exists($p->foto))
        <img src="{{url('storage/'.$p->foto)}}"
             style="width: 80px; height: 50px" 
             alt="Foto do Produto"> 
      @else
        <img src="{{url('storage/fotos/semfoto.jpg')}}"
             style="width: 80px; height: 50px" 
             alt="Sem foto"> 
      @endif
    </td>  
    <td> 
       
        <a href="{{route('produtos.edit', $p->id)}}" 
            class="btn btn-warning btn-sm" title="Alterar"
            role="button"><i class="fa fa-edit"></i></a> &nbsp;&nbsp;
        <form style="display: inline-block"
              method="post"
              action="{{route('produtos.destroy', $p->id)}}"
              onsubmit="return confirm('Confirma Exclusão?')">
               {{method_field('delete')}}
               {{csrf_field()}}
              <button type="submit" title="Excluir"
                      class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
        </form>
                  
    </td>
  </tr>
  @if ($loop->iteration == $loop->count && $acao == 1)
    <tr><td colspan=9>Nº de Produtos cadastrados : {{ $numProd}}
        </td></tr> 
  @endif

@empty
  <tr><td colspan=8> Não há produtos cadastrados ou filtro da pesquisa não 
                     encontrou registros </td></tr>
@endforelse
</table>


@endsection

@section('js')
  <script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js" integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+" crossorigin="anonymous"></script>
@endsection