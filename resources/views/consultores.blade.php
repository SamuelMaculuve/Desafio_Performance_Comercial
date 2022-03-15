<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>

    </style>
</head>
<body>
<div class="flex-center position-ref full-height">

    <div class="content">
        <div class="title m-b-md">
            Laravel
        </div>

        <div class="links">
            <a href="https://laravel.com/docs">Docs</a>
            <a href="https://laracasts.com">Laracasts</a>
            <a href="https://laravel-news.com">News</a>
            <a href="https://blog.laravel.com">Blog</a>
            <a href="https://nova.laravel.com">Nova</a>
            <a href="https://forge.laravel.com">Forge</a>
            <a href="https://vapor.laravel.com">Vapor</a>
            <a href="https://github.com/laravel/laravel">GitHub</a>
        </div>
        @php
            $co_usuario = '';
            $mes = '';
        @endphp
        @foreach ($consultores as $consultor)
{{--            @if ($mes != date("m",strtotime($consultor->data_emissao)))--}}
            @if ($co_usuario != $consultor->co_usuario)
                <table id="pesquisaAvancada" width="100%" cellspacing="1" cellpadding="3" bgcolor="#cccccc" style="padding-top: 100px;">
                    <tbody>

                        <tr bgcolor="#efefef">
                            <td colspan="5"><span class="style3">{{ $consultor->co_usuario }}</span>

                            </td>
                        </tr>

                    <tr bgcolor="#fafafa">
                        <td nowrap=""><div align="center"><strong>Período</strong></div></td>
                        <td><div align="center"><strong>Receita Líquida </strong></div></td>
                        <td><div align="center"><strong>Custo Fixo </strong></div></td>
                        <td><div align="center"><strong>Comissão</strong></div></td>
                        <td><div align="center"><strong>Lucro</strong></div></td>
                    </tr>

                    <tr bgcolor="#8b0000">
                        <td nowrap="">
                            {{ date("m",strtotime($consultor->data_emissao)) }}
                            de
                            {{ date("y",strtotime($consultor->data_emissao)) }}
                        </td>
                        <td><div align="right">R$ 1.500,00</div></td>
                        <td><div align="right">- R$ 2.000,00</div></td>
                        <td><div align="right">- R$ 1.000,00</div></td>
                        <td><div align="right"><font color="#FF0000">- R$ 1.500,00</font></div></td>
                    </tr>

{{--                    <tr bgcolor="#efefef">--}}
{{--                        <td nowrap="" bgcolor="#efefef"><strong>SALDO</strong></td>--}}
{{--                        <td><div align="right"><font color="#000000">R$ 26.500,00</font></div></td>--}}
{{--                        <td><div align="right"><font color="#000000">- R$ 4.000,00</font></div></td>--}}
{{--                        <td><div align="right"><font color="#000000">- R$ 3.500,00</font></div></td>--}}
{{--                        <td><div align="right"><font color="#0000FF">R$ 19.000,00</font></div></td>--}}
{{--                    </tr>--}}


            @else
             <tr bgcolor="#663399">
                <td nowrap="">
                    {{ date("m",strtotime($consultor->data_emissao)) }}
                    de
                    {{ date("y",strtotime($consultor->data_emissao)) }}
                </td>
                <td><div align="right">R$ 1.500,00</div></td>
                <td><div align="right">- R$ 2.000,00</div></td>
                <td><div align="right">- R$ 1.000,00</div></td>
                <td><div align="right"><font color="#FF0000">- R$ 1.500,00</font></div></td>
            </tr>
                    </tbody>
                </table>
            @endif

            @php
                $co_usuario = $consultor->co_usuario ;
                $mes = date("m",strtotime($consultor->data_emissao));
            @endphp

        @endforeach

    </div>
</div>
</body>
</html>
