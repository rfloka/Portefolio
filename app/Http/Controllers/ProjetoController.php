<?php

namespace App\Http\Controllers;

use App\Contacto;
use App\Http\Requests;
use App\Projeto;
use Illuminate\Http\Request;
use App\Http\Resources\Projeto as ProjetoResource;
use DB;
use Response;

class ProjetoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $projectos = DB::table('projetos')
            ->join('fotos', 'projetos.id', '=', 'fotos.projeto_id')
            ->select('projetos.*', 'fotos.nome')->where('fotos.head', 1)->orderBy('created_at', 'desc')
            ->paginate(6);
        return Response::json($projectos);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $projeto = Projeto::find($id);
        $fotos = DB::select('select * from fotos where projeto_id = :id ',['id' => $id]);
        return view('ProjetoDetail',['projeto' => $projeto],['fotos' => $fotos]);
    }
    public function enviarmensagem(Request $request)
    {   
        $contacto = new Contacto;
        $contacto->nome=$request->input('nome');
        $contacto->email=$request->input('email');
        $contacto->telefone=$request->input('telefone');
        $contacto->mensagem=$request->input('mensagem');
        $contacto->save();
    }      
}
