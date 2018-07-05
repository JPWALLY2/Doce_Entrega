@extends('adminlte::page')

@section('title', 'Cadastro de Produtos')

@section('content_header')
       <!-- <div class="col-sm-4">
     <form method="POST"
           class="form-inline" 
           action="{{ route('produtos.pesq')}}">
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
        </div> -->
@endsection

@section('content')

<table class="table table-striped">
  <tr>
    <th> Tipo </th>
    <th> Nome </th>
    <th> Descrição </th>
    <th> Preço R$ </th>
    <th> Ações </th>
  </tr>  
@forelse($produtos as $p)
  <tr>
    <td> {{$p->tipo->nome}} </td>
    <td> {{$p->nome}} </td>
    <td> {{$p->descricao}} </td>
    <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{number_format($p->preco, 2, ',', '.')}} </td>
    <td> 
        <form style="display: inline-block"
              method="post"
              action="{{route('produtos.destroy', $p->id)}}"
              onsubmit="return confirm('Confirma Exclusão?')">
               {{method_field('delete')}}
               {{csrf_field()}}
              <button type="submit" title="Pedir"
                      class="btn btn-info">Pedir</button>
        </form>
                  
    </td>
  </tr>
  @if ($loop->iteration == $loop->count && $acao == 1)
    <tr><td colspan=9>Nº de Produtos : {{ $numProd}}
        </td></tr> 
  @endif

@empty
  <tr><td colspan=8> Não há produtos para filtro de pesquisa </td></tr>
@endforelse
</table>


@endsection

@section('js')
  <script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js" integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+" crossorigin="anonymous"></script>
@endsection