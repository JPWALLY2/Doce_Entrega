<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Produto;
use App\Usuario;

class ProdutosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $produtos = Produto::all();
        return view('admin.produtos_list', compact('produtos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $usuarios = Usuario::orderBy('nome')->get();
        $acao = 1;
        return view('admin.produtos_form', compact('usuarios', 'acao'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'tipo' => 'required|min:4|max:20',
            'nome' => 'required|min:4|max:20',
            'preco' => 'required',
            'descricao' => 'required|min:5|max:100'
        ]);
        // recupera todos os campos do formulário
        $produtos = $request->all();
        // insere os dados na tabela
        $prod = Produto::create($produtos);
        if ($prod) {
            return redirect()->route('produtos.index')
                ->with('Produto Incluído!');
        }
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
        $reg = Produto::find($id);
        $usuarios = Usuario::orderBy('nome')->get();
        $acao = 2;

        return view('admin.produtos_form', compact('reg', 'usuarios', 'acao'));
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
        $this->validate($request, [
            'tipo' => 'required|min:4|max:20',
            'nome' => 'required|min:4|max:20',
            'preco' => 'required',
            'descricao' => 'required|max:100'
        ]);

        $reg = Produto::find($id);
        $dados = $request->all();
        $alt = $reg->update($dados);
        if ($alt) {
            return redirect()->route('produtos.index')
                ->with('Produto Alterado!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produtos = Produto::find($id);
        if ($produtos->delete()){
            return redirect() ->route('produtos.index')
                ->with('Excluído com Sucesso');
        }
    }
}
