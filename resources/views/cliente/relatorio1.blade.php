@extends('layouts.baseExtra')
@php( $titulo = 'Cliente')
@section('titulo',$titulo)
@section('conteudo')
    <!-- content-left -->
      @include('inc.content_left')
    <!-- content-left -->
    <div class="az-content-body pd-lg-l-40 d-flex flex-column">
        @include('inc.breadcrumb')
        <h2 class="az-content-title"> {{ $titulo }}</h2>
        @php
            $co_usuario = '';

        @endphp
        <div class="col-12">
            <table class="table mg-b-0">
                <thead>
                <tr>
                    <td>Periodo</td>
                @foreach ($collection_nomes as $data)
                    <td>{{ $data->nome }}</td>
                @endforeach
                </tr>
                </thead>
                <tbody>
                <tr>
{{--                @for ($i = 0; $i < 12; $i++)--}}
                    @foreach ($collection_nomes as $data111)
                        {{--                        @if($data->months == $i)--}}
                        @foreach ($collection_mes_1 as $data)

                        @if($data111->nome == $collection_mes_1->nome)
                                <th scope="row">{{ $data->soms }} </th>
                        @endif
                        @endforeach
{{--                        @endif--}}
                    @endforeach
{{--                @endfor--}}
                </tr>
                </tbody>
            </table>
        </div>

    </div><!-- content-body -->

@endsection
