<?php

namespace App\Http\Controllers;

use App\Models\EmailList;
use Illuminate\Http\Request;
use App\Models\FileUpload;

use Illuminate\Support\Facades\Mail;

class EmailListController extends Controller
{
    //
    public function show(){
        $list = EmailList::all();
        return response()->json($list);
    }

    public function upload(Request $request){
        

        $request->validate([
            'nome' => 'required',
            'email' => 'required',
            'telefone' => 'required',
            'mensagem' => 'required',
            'file' => 'required|mimes:pdf,doc,docx,odt,txt|max:500'
        ]);

        $emailList = new EmailList();

        if($request->file()) {
            $file_name = time().'_'.$request->file->getClientOriginalName();
            $file_path = $request->file('file')->storeAs('uploads', $file_name, 'public');

            $emailList->fileName = time().'_'.$request->file->getClientOriginalName();
            $emailList->filePath = '/storage/' . $file_path;
        }
        
        $emailList->ip = $_SERVER['REMOTE_ADDR'];
        $emailList->nome = $request->nome;
        $emailList->email = $request->email;
        $emailList->mensagem = $request->mensagem;
        $emailList->telefone = $request->telefone;
        $emailList->save();

        Mail::to(env('MAIL_FROM_ADDRESS'))->send(new \App\Mail\CadastroMessageEmail($emailList));

        return response()->json(['success'=>'Cadastro feito com sucesso.']);
   }
}
