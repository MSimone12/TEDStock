<!DOCTYPE html>
<html lang="en" style="height: 100%;">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('titulo')</title>

        <!-- Fonts -->
        <script src="https://use.fontawesome.com/a104bcefff.js"></script>
        <link rel="stylesheet" href="css/master.css">
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb"crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    </head>
    <body style="height: 100vh;">
      <script type="text/javascript">
      $(document).ready(function(){
        $('.popup').hide();
        $('#btnDownload').click(function(){
          var id = $('input[name=inputId]').val();
          console.log("cliquei no download");
          $('.download').load('/download/'+id);
        });
        $('#btnAdd').click(function(){
          // console.log("oiiiii");
            // event.preventDefault();
            var formAdd = $('#form-add');
            var formData = new FormData();
            var nome = $('#add-form input[name=nome]').val();
            var tags = $('#add-form input[name=tags]').val();
            var imagem = document.getElementById('imagem');
            var token = $('#add-form input[name=_token]').val();

            // console.log(formData);
            formData.append('imagem', imagem.files[0]);
            formData.append('nome', nome);
            formData.append('tags', tags);
            formData.append('_token', token);
            console.log(formData.getAll('_token'));
            $.ajax({
                url: "/add",
                type: 'POST',
                data: formData,
                success: function (data) {
                    alert("Sucesso")
                    $('.modal').modal('toggle');
                },
                cache: false,
                contentType: false,
                processData: false,
                xhr: function() {  // Custom XMLHttpRequest
                    var myXhr = $.ajaxSettings.xhr();
                    if (myXhr.upload) { // Avalia se tem suporte a propriedade upload
                        myXhr.upload.addEventListener('progress', function () {
                            /* faz alguma coisa durante o progresso do upload */
                        }, false);
                    }
                return myXhr;
                }
            });
            // // console.log(imagem);
            // $('#load').load("{{route('adicionar')}}", formData);
        });
        $('.figure').click(function(){
          var id = $(this).children('input[type=hidden]').val();
          $('.popup').load('/img/'+id).toggle();
        });
      });
      </script>
      <nav class="navbar navbar-dark col-12" style="background-color: rgb(0,31,48);">
        <div class="col">
          @if (Auth::guest())

          @else
            <button class="btn navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          @endif
        </div>
        <a href="{{url('/')}}" class="col text-center">
          <img class="navbar-brand" src="{{asset('img/logo.png')}}" alt="" style="display:inline-block;">
        </a>
        <div class="col text-right nav justify-content-end nav-item" style="font-size: 1em;">
        @if(Auth::guest())
          <span style="color: #fff" class="nav-item">
            <a href="{{url('/login')}}" class="nav-link text-white">
              Entrar
            </a>
          </span>
          &nbsp;&nbsp;
          <img src="{{asset('img/pipe.png')}}" alt="" class="nav-item">
          &nbsp;&nbsp;
          <span style="color: #fff" class="nav-item">
            <a href="{{url('/register')}}" class="nav-link text-white">
              Registrar-se
            </a>
          </span>
          @else
          <div class="dropdown">
            <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{ Auth::user()->name }}
            </button>
            <div class="dropdown-menu dropdown-ted" aria-labelledby="dropdownMenuButton">
              <a href="{{ url('/logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();" style="width:inherit;" class="dropdown-item">
              Logout

              </a>
              <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
              </form>
            </div>
          </div>
          @endif
        </div>
      </nav>
