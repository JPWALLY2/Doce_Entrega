<?php

namespace App\Http\Controllers\Fornecedores;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tipo;

class TipoFornController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipos = Tipo::where('usa', 2)->get();
        $numTipoforn = Tipo::count('id');
        return view('fornecedor.tipos_list', compact('tipos', 'numTipoforn')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fornecedor.tipos_form',['acao' => 1]);
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
            'nome' => 'required|unique:tipos|min:2|max:10',
            
            
        ]);
       
       $req = $request->all();

        $tip = Tipo::create($req);

        if ($tip) {
            return redirect()->route('tipos.index')
                ->with('status' , $request->nome . ' inserida com sucesso!!');
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
        $ed = Tipo::find($id);
        return view('admin.tipos_form', ['reg' => $ed, 'acao' => 3]);
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
        
        $reg = Tipo::find($id);
        
                $dados = $request->all();
        
                $tip = $reg->update($dados);
        
                // se alterou
                if ($tip) {
                    return redirect()->route('tipos.index')
                        ->with('status', $request->nome . ' alterada com sucesso!!');
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
       
        $reg = Tipo::find($id);
        
                if ($reg->delete()) {
                    return redirect()->route('tipos.index')
                        ->with('status', $reg->nome . ' excluída corretamente!!');
                }
            
    }
}
