@extends('adminlte::page')

@section('title', 'Cadastro de Tipos de Produtos')

@section('content_header')
    <h1>
    <a href="{{ route('tipos.create') }}" 
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
    <th> Nome </th>   
    <th> Ações </th>
  </tr>  
@forelse($tipos as $t)
  <tr>
    <td> {{$t->nome}} </td>  
    <td> 
        <a href="{{route('tipos.edit', $t->id)}}" 
            class="btn btn-warning btn-sm" title="Alterar"
            role="button"><i class="fa fa-edit"></i></a> &nbsp;&nbsp;
        <form style="display: inline-block"
              method="post"
              action="{{route('tipos.destroy', $t->id)}}"
              onsubmit="return confirm('Confirma Exclusão?')">
               {{method_field('delete')}}
               {{csrf_field()}}
              <button type="submit" title="Excluir"
                      class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
        </form>
                  
    </td>
  </tr>
  @if ($loop->iteration == $loop->count)
    <tr><td colspan=8>Nº de Tipos de Produtos cadastrados : {{ $numTipo}}
        </td></tr> 
  @endif

@empty
  <tr><td colspan=8> Não há tipos de produtos cadastrados </td></tr>
@endforelse
</table>

{{ $tipos->links() }}

@endsection

@section('js')
  <script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js" integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+" crossorigin="anonymous"></script>
@endsection