<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Produto;
use App\User;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $produtos = Produto::paginate(7);
        $numProd = Produto::count('id');
        return view('admin.produtos_list', compact('produtos', 'numProd'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::orderBy('nome')->get();
        $acao = 1;
        return view('admin.produtos_form', compact('user', 'acao'));
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
            'nome' => 'required|min:4|max:20',
            'tipo' => 'required|min:4|max:20',
            'descricao' => 'required|min:5|max:100'
        ]);
        // recupera todos os campos do formulário
        $produtos = $request->all();
        
        // se campo foto foi preenchido e enviado (válido)
        if ($request->hasFile('foto') && 
            $request->file('foto')->isValid()) {
                // salva o arquivo e retorna um id único
                $path = $request->file('foto')->store('fotos');

                $produtos['foto'] = $path;
            }    

        
        // insere os dados na tabela
        $prod = Produto::create($produtos);
        if ($prod) {
            return redirect()->route('produtos.index')
                 ->with('status', $request->nome . ' inserido com sucesso!');
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
        $user = User::orderBy('nome')->get();
        $tip = Produto::tipos();
        $acao = 2;

        return view('admin.produtos_form', compact('reg', 'user', 'acao', 'tip'));
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
        // obtém os dados do form
        $produtos = $request->all();

        // posiciona no registo a ser alterado
        $reg = Produto::find($id);

        // se campo foto foi preenchido e enviado (válido)
        if ($request->hasFile('foto') && 
            $request->file('foto')->isValid()) {
                // salva o arquivo e retorna um id único
                $path = $request->file('foto')->store('fotos');

                $produtos['foto'] = $path;
    
                // se existe, exclui a foto antiga
                if (Storage::exists($reg->foto)) {
                    Storage::delete($reg->foto);
                }
        }
    
        // realiza a alteração
        $alt = $reg->update($produtos);

        if ($alt) {
            return redirect()->route('produtos.index')
                            ->with('status', $request->nome . ' Alterado!');
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
        $prod = Produto::find($id);
        if ($prod->delete()) {
            if (Storage::exists($prod->foto)) {
                Storage::delete($prod->foto);
            }
            return redirect()->route('carros.index')
                            ->with('status', $prod->nome . ' Excluído!');
        }
    }
}
