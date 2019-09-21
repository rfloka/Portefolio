<?php

namespace App\Http\Controllers;

use Auth;
use App\Projeto;
use App\Contacto;
use Illuminate\Http\Request;
use Storage;
use DB;

class AdminController extends Controller
{
    public function index()
    {
        if (!Auth::check() or Auth::user()->role == "0"  )  {
            return redirect('/');
        }
        $projetos = Projeto::all();
        $contactos = Contacto::all();
        return view('admin.dashboard',['projetos' => $projetos,'contactos'=>$contactos]);
    }
    //viaturas
    public function addProjeto()
    {
        if (!Auth::check() or Auth::user()->role == "0"  )  {
            return redirect('/');
        }
        $projetos = Projeto::all();
        return view('admin.AddProjeto');
    }
    public function guardarprojeto(Request $request){
        $request->validate([
            'titulo' => 'required|max:50|min:3',
            'gitrepo' => 'required|max:50|min:3',
            'url' => 'required|max:50|min:2',
            'descricao' => 'required',
        ]);
        $projeto = new Projeto;
        $projeto->titulo = $request->input('titulo');
        $projeto->gitrepo = $request->input('gitrepo');
        $projeto->url = $request->input('url');
        $projeto->descricao = $request->input('descricao');
        $projeto->save();
        $projetoID = $projeto->id;     
        $fotos = $request->file('fotos');
        if(!empty($fotos)):
            $i=0;
            foreach ($fotos as $foto) {
                $id =random_int(1, 999);
                $i++;
                $nome = $request->input('titulo').$i."_".$id.".".$foto->getClientOriginalExtension();
                Storage::put("/public/projetospics/$nome", file_get_contents($foto));
                DB::insert('insert into fotos (nome,projeto_id,head) values (?,?,?)', [$nome, $projetoID,0]);
            }
        else:
            DB::insert('insert into fotos (nome,projeto_id,head) values (?,?,?)', ["holder.jpg", $projetoID,1]);
        endif;
        return redirect()->back()->with('alert', 'Projeto Adicionado! Escolha uma Foto Principal');
    }
    public function editprojeto($id)
    {
        $projeto = Projeto::find($id);
        $fotos = DB::select('select * from fotos where projeto_id = :id ',['id' => $id]);
        return view('admin.EditProjeto',['projeto' => $projeto],['fotos' => $fotos]);
    }
    public function updateprojeto(Request $request,$id)
    {
        $request->validate([
            'titulo' => 'required|max:50|min:3',
            'gitrepo' => 'required|max:50|min:3',
            'url' => 'required|max:50|min:2',
            'descricao' => 'required',
        ]);
        $projeto = Projeto::find($id);
        $projeto->titulo = $request->input('titulo');
        $projeto->gitrepo = $request->input('gitrepo');
        $projeto->url = $request->input('url');
        $projeto->descricao = $request->input('descricao');
        $projeto->save();
        $viaturaID = $projeto->id;    
        $fotos = $request->file('fotos');
        if(!empty($fotos)):
            $i=0;
            foreach ($fotos as $foto) {
                $id =random_int(1, 999);
                $i++;
                $nome = $request->input('titulo').$i."_".$id.".".$foto->getClientOriginalExtension();
                Storage::put("/public/projetospics/$nome", file_get_contents($foto));
                DB::insert('insert into fotos (nome,projeto_id,head) values (?,?,?)', [$nome, $viaturaID,0]);
            }
        endif;
        return redirect()->back()->with('alert', 'Viatura Modificada!');
    }
    public function deletefoto($id){
        $foto = DB::table('fotos')->where('id', $id)->pluck('nome')->first();
        if($foto != 'holder'){
            Storage::delete('/public/projetospics/'.$foto);
        }
        $deleted = DB::delete('delete from fotos where id = ?', [$id]);
        return redirect()->back()->with('alert', 'Foto Eliminada');
    }

    public function changefoto($id)
    {
        $projeto_id =  DB::table('fotos')->where('id', $id)->pluck('projeto_id');
        DB::table('fotos')
            ->where([['projeto_id', $projeto_id],['head',1]])
            ->update(['head' => 0]);
        DB::table('fotos')
            ->where('id',$id)
            ->update(['head' => 1]);
        return redirect()->back()->with('alert', 'Foto Principal Modificada');
    }

    public function deleteprojeto($id){
        $nomes =  DB::table('fotos')->where('projeto_id', $id)->pluck('nome');
        foreach ($nomes as $nome) {
            Storage::delete('/public/projetopics/'.$nome);
        }
        $deleted = DB::delete('delete from fotos where projeto_id = ?', [$id]);
        $projeto = Projeto::find($id);
        $projeto->delete();
        return redirect('/admin')->with('success', 'Viatura Removida');
    }
    public function mostrarcontacto($id){
        if (!Auth::check() or Auth::user()->role == "0"  )  {
            return redirect('/');
        }
        $contacto = Contacto::find($id);
        return view('admin.ShowContacto',['contacto' => $contacto]);
    }
    public function deletecontacto($id){
        if (!Auth::check() or Auth::user()->role == "0"  )  {
            return redirect('/');
        }
        $contacto = Contacto::find($id);
        $contacto->delete();
        return redirect('/admin')->with('success', 'Mensagem Removido');
    }
}
