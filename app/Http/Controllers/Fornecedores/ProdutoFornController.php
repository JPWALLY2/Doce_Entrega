<?php

namespace App\Http\Controllers\Fornecedores;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tipo;
use App\Produto;

class ProdutoFornController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $produtosforn = Produto::where('us', 2)->get();
        $numProdforn = Produto::where('us', 2)->count('id');
        $acao = 1; 
        return view('fornecedor.produtos_list', compact('produtosforn', 'numProdforn', 'acao'));
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipoforn = Tipo::orderBy('nome')->get();
        $acao = 1;
        return view('fornecedor.produtos_form', compact('acao', 'tipoforn'));
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
            'descricao' => 'required|min:5|max:100',
        ]);
        // recupera todos os campos do formulário
        $produtos = $request->all();
            


        
        // insere os dados na tabela
        $prod = Produto::create($produtos);
        ['us' => $request->us,
        'nome' => $request->nome,
        'descricao' => $request->descricao,
        'preco' => $request->preco,
        'tipo_id' => $request->tipo_id];
        if ($prod) {
            return redirect()->route('produtosforn.index')
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
        $tipo = Tipo::orderBy('nome')->get();
        $acao = 2;

        return view('fornecedor.produtos_form', compact('reg', 'acao', 'tipo'));
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
        $produtosforn = $request->all();
        
                // posiciona no registo a ser alterado
                $reg = Produto::find($id);
        
            
                // realiza a alteração
                $alt = $reg->update($produtosforn);
        
                if ($alt) {
                    return redirect()->route('produtosforn.index')
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
            return redirect()->route('produtosforn.index')
                            ->with('status', $prod->nome . ' Excluído!');
        }
    }
    
    public function pesq(Request $request) {
        
        $acao = 2;
        $dados = Produto::where('us', 2)->join('tipos', 'tipos.id', 'produtos.tipo_id')
                           ->where('produtos.nome', 'like','%'.$request->palavra.'%')
                           ->orwhere('tipos.nome', 'like','%'.$request->palavra.'%')
                           ->select('produtos.*')
                           ->get();
        
       return view('fornecedor.produtos_list', compact('acao'), ['produtos' => $dados,
                        'palavra' => $request->palavra]);
 
   }
}
