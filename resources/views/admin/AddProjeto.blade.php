<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        window.Laravel = {
            csrfToken: '{{ csrf_token()}}'
        }
    </script>
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/estilos.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/2f5b61e367.js"></script>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <h1>Novo Projeto</h1>
        </div>
        @if (session('alert'))
        <div class="alert alert-warning" role="alert">
                {{ session('alert') }}
        </div>
    @endif
    @if ($errors->any())
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger" role="alert">
                {{ $error }}
        </div>
        @endforeach
    @endif
        <form method="POST" action="/admin/projetos/guardar" id="form_viatura" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="tituloinput">Titulo</label>
                <input type="text" name="titulo" class="form-control" id="tituloinput" aria-describedby="emailHelp"
                    placeholder="Inseria um Titulo">
            </div>
            <div class="form-group">
                    <label for="gitinput">GitRepo</label>
                    <input type="text" name="gitrepo" class="form-control" id="gitinput" aria-describedby="emailHelp"
                        placeholder="Inseria um GitRepo">
            </div>
            <div class="form-group">
                    <label for="urlinput">Url</label>
                    <input type="text" name="url" class="form-control" id="urlinput" aria-describedby="emailHelp"
                        placeholder="Inseria um Url">
            </div>
            <div class="form-group">
                    <label for="exampleFormControlFile1">Fotografias</label>
                    <input name="fotos[]" type="file" class="form-control-file" id="fotos" multiple>
                </div>
            <div>
                    <label for="exampleFormControlTextarea1">Descrição</label>
                    <textarea name="descricao" class="form-control" id="article-ckeditor" rows="5"></textarea>
                </div>
                <hr>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <!--editor-->
    <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
    <script>
    CKEDITOR.replace('article-ckeditor');
</script>
<!--editor-->
</body>

</html>