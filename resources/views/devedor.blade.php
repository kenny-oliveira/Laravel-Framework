<script> 

function Consultar(){
var Div = document.getElementById('procurarDiv')

if (Div.style.display != "none"){
    Div.style.display = 'none'
}else{
    Div.style.display = 'block'
}
}

function Inserir(){
var Div = document.getElementById('InserirDiv')

if (Div.style.display != "none"){
    Div.style.display = 'none'
}else{
    Div.style.display = 'block'
}
}




function formatCpf()
{
 var value =  document.getElementById('cpf').value
 var cnpjCpf = value.replace(/\D/g, '');
  if (cnpjCpf.length === 11) {
      cnpjCpf = cnpjCpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/g, "\$1.\$2.\$3-\$4");
      document.getElementById('cpf').value = cnpjCpf;
  }
  else if (value.length > 14) {
    document.getElementById('cpf').value = "";
  }
  else{
    var regex = /[.,\s]/g;
    var cnpjCpf = cnpjCpf.replace(regex, '');
    document.getElementById('cpf').value = cnpjCpf;
    }
}



</script>  

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                   
                    <div>                    
                       <button onclick="Consultar()" id='Consultar'>Consultar</button> <button onclick="Inserir()" id='Inserir'>Inserir</button>
                       <div id ='InserirDiv' style='display:none;'>
                       <hr>
                       <form method="GET">
                       <p style="display: inline-block; margin-right: 10px;">Nome: </p><input type='text' name='name' id='name' placeholder="Nome"><br>
                       <p style="display: inline-block; margin-right: 25px;">Cpf: </p><input type='text' maxlength="11" oninput="formatCpf()" name='cpf' id='cpf' placeholder="cpf"><br>
                       <p style="display: inline-block; margin-right: 10px;">Valor da divida: </p><input type='text' name='value' id='value' placeholder="Divida"><br>
                       <a href="create"><button>Inserir</button></a>
                       </form>
                       </div>

                       <div id='procurarDiv' style="display:none;">
                       <hr>
                       <table style="width:100%">
                       <tr>
                       <th>id</th>
                       <th>Nome</th>
                       <th>Cpf</th> 
                       <th>Valor</th>
                       <th>Opçôes</th>
                       </tr>
                       <?php
                       foreach ($debts as $debt) {
                            echo '<tr id=','TR',$debt->id,'>';
                            echo "<td>",$debt->id,"</td>"; 
                            echo "<td>",$debt->name,"</td>";
                            echo "<td>",$debt->cpf,"</td>";
                            echo "<td>",$debt->value,"</td>";
                            echo "<td><a href=''><button>Update","</button></a>";
                            echo "<a href='delete/$debt->id'><button>X","</button></a></td>";
                            echo '</tr>';
                       }
                        ?>

                       </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
