<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\debts;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;

use function GuzzleHttp\Promise\all;

class debtscontroller extends Controller
{

public function readAll(){
    $debts = debts::get();
    return $this->SendData($debts);
}

public function __construct()
{
    $this->middleware('auth');
}


public function index()
{
    $debts = DB::table('debts')->get();
    return view('devedor', ['debts' => $debts]);
}



    public function Create(Request $request){
      $data = $request -> all();
      $result = debts::create($data);
      if ($result){
          echo '<script>alert("Debito Cadastrado com Sucesso")</script>'; 
          return $this->SendSuccess("Debito Cadastrado com Sucesso",$result->id);
      }
      else{
        echo '<script>alert("Falha ao Cadastrar Debito")</script>'; 
          return $this->SendError("Falha ao Cadastrar Debito");
      }


    }

    public function Delete($id){
      $debt = debts::find($id);
      if (!isset($debt)){
          return $this->SendError("Débito Não Encontrado",404);
      }
       $res = $debt->delete();
       if ($res){
             return $this->SendSuccess("Débito Removido Com Sucesso");
       }else{
             return $this->SendError("Falha ao remover Débito");
       }
    }

    public function Update($id,Request $request){
        $debt = debts::find($id);
        if (!isset($debt)){
            return $this->SendError("Débito Não Encontrado",404);
        }
        $data = $request -> all();
        $result = $debt->Update($data);
        if ($result){
            return $this->SendSuccess("Débito Atualizado Com Sucesso");
        }else{
            return $this->SendError("Falha ao Atualizar Débito");
        }
        
    }


}
