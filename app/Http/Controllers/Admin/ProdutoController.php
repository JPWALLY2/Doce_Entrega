<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Produto;
use App\User;
use App\Tipo;

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
        $acao = 1; 
        return view('admin.produtos_list', compact('produtos', 'numProd', 'acao'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $user = User::orderBy('name')->get();
        $tipo = Tipo::orderBy('nome')->get();
        $acao = 1;
        return view('admin.produtos_form', compact('user', 'acao', 'tipo'));
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
            'estoque' => 'required'
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
        $user = User::orderBy('name')->get();
        $tipo = Tipo::orderBy('nome')->get();
        $acao = 2;

        return view('admin.produtos_form', compact('reg', 'user', 'acao', 'tipo'));
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
        $car = Produto::find($id);
        if ($car->delete()) {
            if (Storage::exists($car->foto)) {
                Storage::delete($car->foto);
            }
            return redirect()->route('produtos.index')
                            ->with('status', $car->nome . ' Excluído!');
        }
    }
    
     public function graf() {
        $sql = "select t.nome as tipo, count(p.id) as num 
                from produtos p
                inner join tipos t
                on p.tipo_id = t.id
                group by t.nome";

        $dados = DB::select($sql);                

        return view('admin.produtos_graf', ['dados'=>$dados]);
    }
    
     public function pesq(Request $request) {
         
         $acao = 2;
         $dados = Produto::join('tipos', 'tipos.id', 'produtos.tipo_id')
                            ->where('produtos.nome', 'like','%'.$request->palavra.'%')
                            ->orwhere('tipos.nome', 'like','%'.$request->palavra.'%')
                            ->select('produtos.*')
                            ->get();
         
        return view('admin.produtos_list', compact('acao'), ['produtos' => $dados,
                         'palavra' => $request->palavra]);
  
    }
    
    public function wsxml($nome = null) {
      // indica o tipo de retorno do método
      header("Content-type: application/xml");

      // inicializa a biblioteca SimpleXML
      $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><produtos></produtos>');

      // se não foi passado $nome
      if ($nome == null) {
          $item = $xml->addChild("produto");
          $item->addChild("status", "url incorreta");
          $item->addChild("descricao", null);
          $item->addChild("preco", null);
          $item->addChild("user_id", null);
          $item->addChild("tipo_id", null);
      } else {
          // obtém o registro 
          $lista = Produto::where('nome', $nome)->get();

          // se encontrou
          if (isset($lista)) {
            $item = $xml->addChild("produto");
            foreach ($lista as $reg){
            $item->addChild("descricao", $reg->descricao);
            $item->addChild("preco", $reg->preco);                
            $item->addChild("user_id", $reg->user->name);
            $item->addChild("tipo_id", $reg->tipo->nome);
            }
          } else {
            $item = $xml->addChild("produto");
            $item->addChild("status", "inexistente");
            $item->addChild("descricao", null);
            $item->addChild("preco", null);
            $item->addChild("user_id", null);                
            $item->addChild("tipo_id", null);
          }
      }           
      // retorna os dados no formato xml
      echo $xml->asXML();
  }
   public function ws($id = null) {
    // indica o tipo de retorno do método
    header("Content-type: application/json; charset=utf-8");

    // verifica se $id não foi passado
    if ($id == null) {
      $retorno = array("descricao" => null,
                       "preco" => null,
                       "user_id" => null,
                       "tipo_id" => null);  
    } else {
      // busca o carro cujo id foi passado por parâmetro
      $reg = Produto::find($id);
      
      // verifica se encontrou o registro
      if (isset($reg)) {
        $retorno = array("descricao" => $reg->descricao,
                         "preco" => $reg->preco,
                         "user_id" => $reg->user->name,
                         "tipo_id" => $reg->tipo->nome);  
      } else {
        $retorno = array("descricao" => null,
                       "preco" => null,
                       "user_id" => null,
                       "tipo_id" => null);           
      }
    }

    // converte array para o formato json
    echo json_encode($retorno, JSON_PRETTY_PRINT);
  }


}
