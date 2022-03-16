@extends('layouts.baseExtra')
@php( $titulo = 'Por Consultor')
@section('titulo',$titulo)

@section('conteudo')
<!-- content-left -->
@include('inc.content_left')
<!-- content-left -->
<div class="az-content-body pd-lg-l-40 d-flex flex-column">
    @include('inc.breadcrumb')
    <h2 class="az-content-title"> {{ $titulo }}</h2>
    @include('inc.error_msg')
    <!-- form de pesquisa -->
    @include('inc.form_consultores')
    <!-- form de pesquisa -->
    </div>
    <!-- content-body -->
@endsection
