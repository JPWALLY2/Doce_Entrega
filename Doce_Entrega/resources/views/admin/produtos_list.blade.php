@extends('adminlte::page')

@section('title', 'Cadastro de Produtos')

@section('content_header')
<div class="col-lg-11">
    <h1>Cadastro de Produtos</h1>
</div>
<div class='col-sm-1'>
    <a href='{{route('produtos.create')}}' class='btn btn-primary' 
       role='button'> Novo </a>
</div>
@stop



@section('content')

<table class="table table-striped">
  <thead>
    <tr>
      <th>Tipo</th>
      <th>Nome</th>
      <th>Preço R$</th>
      <th>Descrição</th>
      <th>Cadastrado por:</th>
      <th>Ações</th>
    </tr>
  </thead>
  <tbody>
    @forelse ($produtos as $p)
      <tr>
        <td> {{$p->tipo}} </td>
        <td> {{$p->nome}} </td>
        <td> {{number_format($p->preco, 2, ',', '.')}} </td>
        <td> {{$p->descricao}} </td>
        <td> {{$p->usuarios_id}} </td>
        <td> <a href='{{route('produtos.edit', '$produtos->id')}}'
                        class='btn btn-info'
                        role='button'> Alterar </a>
                     <form style="display: inline-block"
                           method="post"
                           action="{{route('produtos.destroy', $p->id)}}"
                           onsubmit="return confirm('Confirma Exclusão?')">
                           {{ method_field('delete') }}
                           {{ csrf_field() }}
                           <button type="submit"
                                   class="btn btn-danger"> Excluir </button>

                     </form>

                </td>
          <td> <a href='#'
                  class='btn btn-info'
                  role='button'> Alterar </a>
              <form style="display: inline-block"
                    method="post"
                    action="{{route('produtos.destroy', $p->id)}}"
                    onsubmit="return confirm('Confirma Exclusão?')">
                  {{ method_field('delete') }}
                  {{ csrf_field() }}
                  <button type="submit"
                          class="btn btn-danger"> Excluir </button>

              </form>
          </td>

    
        @empty
      <tr><td colspan=8> Não há produtos cadastrados </td></tr>
    @endforelse

  </tbody>
</table>  

@stop