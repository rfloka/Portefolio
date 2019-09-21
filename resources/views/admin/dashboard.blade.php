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
        @if (session('alert'))
        <div class="alert alert-success" role="alert">
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
        <div class="row justify-content-center">
            <h1>Projetos</h1>
            @if (count($projetos) > 0 )
            <table class="table table-hover" id="myTable">
                <thead class="thead">
                    <tr style="background-color:#0F3356;color:#ffff">
                        <th scope="col">ID</th>
                        <th scope="col">Titulo</th>
                        <th scope="col">Repo</th>
                        <th scope="col">Url</th>
                        <th scope="col">Inserido</th>
                        <th scope="col"></th>
                        <th scope="col"><a href="admin/projetos/adicionar/" class="btn btn-success"
                                style="float:right;"><i class="fas fa-plus"></i></a></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($projetos as $projeto)

                    <tr>
                        <th scope="row"> {{$projeto->id}}</th>
                        <td>{{$projeto->titulo}}</td>
                        <td>{{$projeto->gitrepo}}</td>
                        <td>{{$projeto->url}}</td>
                        <td>{{$projeto->created_at}}</td>
                        <td colspan="3">
                            <a class="btn btn-primary" href="/viaturas/{{$projeto->id}}/show"><i
                                    class="fas fa-eye"></i></a>
                            <a href="admin/projeto/{{$projeto->id}}/edit" class="btn btn-warning"><i
                                    class="fas fa-edit"></i></a>
                            <a class="btn btn-danger" data-toggle="modal" data-target="#delete-{{$projeto->id}}"><i
                                    class="fas fa-times"></i></a>
                        </td>
                    </tr>
                    <div class="modal fade bd-example-modal-sm" tabindex="-1" id="delete-{{$projeto->id}}" role="dialog"
                        aria-labelledby="mySmallModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="alert alert-danger" role="alert">
                                    Eliminar {{$projeto->titulo}}
                                </div>
                                <a href="admin/projeto/{{$projeto->id}}/delete" class="btn btn-danger">Sim Eliminar</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
            @else
            <h3 align="center">Sem Projetos registados</h3>
            <a href="admin/projetos/adicionar/" class="btn btn-success"><i class="fas fa-plus"></i></a>
            @endif
        </div>
    
    <HR>
    <!-- CONTACTOS -->
    <div class="row justify-content-center">
        <h1>Contactos</h1>
        @if (count($contactos) > 0 )
        <table class="table table-hover" id="myTable">
            <thead class="thead">
                <tr style="background-color:#0F3356;color:#fff">
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">Enviado</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($contactos as $contacto)

                <tr>
                    <th scope="row"> {{$contacto->id}}</th>
                    <td>{{$contacto->nome}}</td>
                    <td>{{$contacto->email}}</td>
                    <td>{{$contacto->telefone}}</td>
                    <td>{{$contacto->created_at}}</td>
                    <td colspan="3">
                        <a class="btn btn-primary" href="admin/contactos/{{$contacto->id}}/show"><i
                                class="fas fa-eye"></i></a>
                        <a class="btn btn-danger" data-toggle="modal" data-target="#delete-{{$contacto->id}}"><i
                                class="fas fa-times"></i></a>
                    </td>
                </tr>
                <div class="modal fade bd-example-modal-sm" tabindex="-1" id="delete-{{$contacto->id}}" role="dialog"
                    aria-labelledby="mySmallModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="alert alert-danger" role="alert">
                                Eliminar {{$contacto->nome}}
                            </div>
                            <a href="admin/contactos/{{$contacto->id}}/delete" class="btn btn-danger">Sim Eliminar</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
        @else
        <h3 align="center">Sem Contactos registados</h3>
        @endif
    </div>
    </div>
</div>
</body>

</html>