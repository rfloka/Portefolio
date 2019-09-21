@extends('layouts.app')

@section('content')
<div class="container-fluid back">
    <div class="container" style="height:100vh;background-color:#ffff;overflow-y:scroll;overflow-x: hidden;">
        <div class="row">
            <div class="col-1" style="margin-top:3%;">
                <a href="/" class="backicon"><i class="fas fa-arrow-left" style="font-size:50px;"></i></a>
            </div>
            <div class="col-11" style="margin-top:3%;">
                <h1 class="titulo">{{$projeto->titulo}}</h1>
            </div>
        </div>
        <div class="row">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <!--Carousel Wrapper-->
                        <div id="carousel-thumbs" class="carousel slide carousel-fade carousel-thumbnails"
                            data-ride="carousel">
                            <!--Slides-->
                            <div class="carousel-inner" role="listbox">
                                <button class="btn btn-primary fullscreen" style="border-color:#B90FB9;z-index:2;"
                                    onclick="full()"><i class="fas fa-expand"></i></button>
                                @foreach ($fotos as $foto)
                                @if ($foto->head == 1)
                                <div class="carousel-item active caro" style="background-color:#161616;">
                                    <img class="d-block w-100" src="/storage/projetospics/{{$foto->nome}}"
                                        alt="First slide" style="object-fit: contain;height:60vh">
                                </div>
                                @else
                                <div class="carousel-item caro" style="background-color:#161616;">
                                    <img class="d-block w-100" src="/storage/projetospics/{{$foto->nome}}"
                                        alt="First slide" style="object-fit: contain;height:60vh">
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carousel-thumbs" role="button" data-slide="prev">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                        <a class="carousel-control-next" href="#carousel-thumbs" role="button" data-slide="next">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="margin-top:3%;">
            @if ($projeto->url=="none")
            <div class="col-md-6">
                    <a name="" id="" class="btn btn-default butao disabled btn-block" href="#" role="button"><i class="fas fa-globe"></i> Sem Website</a>
            </div>
            @else
            <div class="col-md-6">
                <a name="" id="" class="btn btn-default butao btn-block" href="//{{$projeto->url}}" role="button"><i class="fas fa-globe"></i> Visitar Site</a>
            </div>
            @endif
            @if ($projeto->gitrepo=="none")
            <div class="col-md-6">
                <a name="" id="" class="btn btn-default butao disabled btn-block" href="#" role="button"><i class="fab fa-github"></i> Sem Repositório</a>
            </div>
            @else
            <div class="col-md-6">
                <a name="" id="" class="btn btn-default butao btn-block" href="{{$projeto->gitrepo}}" role="button"><i class="fab fa-github"></i> GIT</a>
            </div>
            @endif
            <div class="row justify-content-center" >
                <div class="col-10" style="margin-top:3%;">
                    {!!$projeto->descricao!!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection