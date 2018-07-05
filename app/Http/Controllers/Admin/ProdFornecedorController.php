<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Produto;

class ProdFornecedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produtos = Produto::where('us', 2)
                ->get();
        $numProd = Produto::where('us', 2)
                ->count('id');
        $acao = 1; 
        return view('admin.produtosfornecedores_list',
                compact('produtos', 'numProd', 'acao'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reg = Produto::find($id);

        if ($reg->delete()) {
            return redirect()->route('produtos.index')
                ->with('status', $reg->nome . ' excluída corretamente!!');
        }
    }
    public function pesq(Request $request)
    {
         $acao = 2;
         $dados = Produto::where('us', 2)->join('tipos', 'tipos.id', 'produtos.tipo_id')
                           ->where('produtos.nome', 'like','%'.$request->palavra.'%')
                           ->orwhere('tipos.nome', 'like','%'.$request->palavra.'%')
                           ->select('produtos.*')
                           ->get();
        
       return view('admin.produtosfornecedores_list', compact('acao'), ['produtos' => $dados,
                         'palavra' => $request->palavra]);
  
    }
    
}
