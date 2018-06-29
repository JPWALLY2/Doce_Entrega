@extends('adminlte::page')

@section('title', 'Cadastro de Produtos')


@section('content')


<table class="table table-striped">
    <h2 align="center"><font size="10" face="French Script MT" color="purple">Produtos com baixo Estoque</font></h2>
@forelse($p as $p)
  
   
<h2><font face="French Script MT" size="10" >{{$p->nome}}<font/></h2>
        
      @if (Storage::exists($p->foto))
        <img src="{{url('storage/'.$p->foto)}}"
             style="width: 260px; height: 200px" 
             alt="Foto do Produto"> 
      @else
        <img src="{{url('storage/fotos/semfoto.jpg')}}"
             style="width: 260px; height: 200px" 
             alt="Sem foto"> 
      @endif
    

@empty
<h2 align="center"><font size="10" face="French Script MT" color="blue">Todos produtos abastecidos!</font></h2>
@endforelse
</table>


@endsection