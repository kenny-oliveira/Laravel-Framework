<script>

function TestaCPF(strCPF) {
    var Soma;
    var Resto;
    Soma = 0;
  if (strCPF == "00000000000") return false;

  for (i=1; i<=9; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);
  Resto = (Soma * 10) % 11;

    if ((Resto == 10) || (Resto == 11))  Resto = 0;
    if (Resto != parseInt(strCPF.substring(9, 10)) ) return false;

  Soma = 0;
    for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
    Resto = (Soma * 10) % 11;

    if ((Resto == 10) || (Resto == 11))  Resto = 0;
    if (Resto != parseInt(strCPF.substring(10, 11) ) ) return false;
    return true;
}

function validacaoEmail() {
field = document.getElementById("email")
usuario = field.value.substring(0, field.value.indexOf("@"));
dominio = field.value.substring(field.value.indexOf("@")+ 1, field.value.length);

if ((usuario.length >=1) &&
    (dominio.length >=3) &&
    (usuario.search("@")==-1) &&
    (dominio.search("@")==-1) &&
    (usuario.search(" ")==-1) &&
    (dominio.search(" ")==-1) &&
    (dominio.search(".")!=-1) &&
    (dominio.indexOf(".") >=1)&&
    (dominio.lastIndexOf(".") < dominio.length - 1)) {
document.getElementById('email').style.border = 'green 1px solid'
}
else{
document.getElementById('email').style.border = 'red 1px solid'
}
}

function Validar(id){
var object = document.getElementById(id).value
if (object.length > 4){
    document.getElementById(id).style.border = 'green 1px solid'
}else{
    document.getElementById(id).style.border = 'red 1px solid'
}


}


function formatCpf(value)
{
 var value =  document.getElementById('cpf').value
 var cnpjCpf = value.replace(/\D/g, '');
  if (cnpjCpf.length === 11) {
      cnpjCpf = cnpjCpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/g, "\$1.\$2.\$3-\$4");
    if (TestaCPF(value) != true){
        document.getElementById('cpf').style.border = 'red 1px solid'
    }else{
          document.getElementById('cpf').style.border = 'green 1px solid'
    }
      document.getElementById('cpf').value = cnpjCpf;
  }
  else if (value.length > 14) {
    document.getElementById('cpf').value = "";
    document.getElementById('cpf').style.border = 'red 1px solid'
  }
  else{
    var regex = /[.,\s]/g;
    var cnpjCpf = cnpjCpf.replace(regex, '');
    document.getElementById('cpf').value = cnpjCpf;
    document.getElementById('cpf').style.border = 'red 1px solid'
    }
}

</script>

@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" placeholder="nome" class="form-control @error('name') is-invalid @enderror" onblur="Validar('name')" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cpf" class="col-md-4 col-form-label text-md-right">{{ __('CPF') }}</label>
                            <div class="col-md-6">
                                <input id="cpf" type="text" placeholder="cpf" class="form-control @error('cpf') is-invalid @enderror" maxlength="11" oninput="formatCpf()" name="cpf" value="{{ old('cpf') }}" required>
                                @error('cpf')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" placeholder="ex: placeholder@email.com" class="form-control @error('email') is-invalid @enderror" onblur="validacaoEmail()" maxlength="60" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Senha') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" placeholder="minimo de 8" minlength="8" class="form-control @error('password') is-invalid @enderror" onblur="Validar('password')"  name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Comfirme a Senha') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" placeholder="minimo de 8" minlength="8" class="form-control" name="password_confirmation" onblur="Validar('password-confirm')" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
