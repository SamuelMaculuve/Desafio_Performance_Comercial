<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    /**
     * Recebe o Request, Lista dos consultores, data inicio e data fim.
     * E em funcao disso, retorna, o relatorio, a pizza , ou grafico ou uma pagina "none"
     * caso nao seja nenhuma das 3 opcoes
     */
    public function con_desempenho_filtrar(Request $request)
    {
        $this->validador($request);

        $clientes = $this->lista_clientes();

        \Session::push('clientes_activos', $request->clientes);
        \Session::put('date_inicio_activo', $request->date_inicio);
        \Session::put('date_fim_activo', $request->date_fim);
        if ($request->submitAction == "relatorio"){

            $lista_mes = $this->meses();

            $relatorio_clientes = $this->relatorio($request);

            return view('cliente.relatorio',compact('relatorio_clientes','clientes','lista_mes'));

        }elseif ($request->submitAction == "pizza"){

            $pizza_clientes = $this->dados_pizza($request);

            return view('cliente.pizza',compact('pizza_clientes','clientes'));

        }elseif ($request->submitAction == "grafico"){

            $resul_grafico = $this->dados_grafico($request);

//            dd($resul_grafico);
//
            return view('cliente.grafico',compact('resul_grafico','clientes'));

        }else{

            view('pagina_none');

        }

    }
    /**
     * Retorna a lista dos Lista de Consultores.
     *
     */
    public function listar_clientes()
    {
        $date_inicio = '2007-01';
        $date_fim = '2007-12';
        $clientes_activos = [];
        $clientes = $this->lista_clientes();

        return view('cliente.con_desempenho',compact('clientes','date_inicio','date_fim','clientes_activos'));

    }

    public function relatorio($request)
    {
        $relatorio_clientes =  DB::table('cao_fatura')
            ->join('cao_cliente', function($join) use ($request)
            {
                $join->on('cao_fatura.co_cliente', '=','cao_cliente.co_cliente')
                    ->whereIn('cao_fatura.co_cliente', $request->clientes);
            })
            ->whereBetween('cao_fatura.data_emissao',[$request->date_inicio.'-01',$request->date_fim.'-01'])
            ->select(DB::raw('cao_cliente.no_fantasia as nome_cliente'),DB::raw('(cao_fatura.valor - cao_fatura.total_imp_inc/100) as sums'),DB::raw("DATE_FORMAT(cao_fatura.data_emissao,'%m') as num_mes"))
            ->orderBy('num_mes', 'asc')
            ->groupBy('num_mes','cao_fatura.co_cliente')
            ->get()
            ->groupBy(function ($item){
                return $item->nome_cliente;
            })
        ;

        return $relatorio_clientes;

    }

    public function dados_grafico($request){

        $clientes =  DB::table('cao_fatura')
            ->join('cao_cliente', function($join) use ($request)
            {
                $join->on('cao_fatura.co_cliente', '=','cao_cliente.co_cliente')
                    ->whereIn('cao_fatura.co_cliente', $request->clientes);
            })
            ->whereBetween('cao_fatura.data_emissao',[$request->date_inicio.'-01',$request->date_fim.'-01'])
            ->select(DB::raw('cao_cliente.no_fantasia as nome_cliente'),
                DB::raw("SUM(cao_fatura.valor - (cao_fatura.total_imp_inc/100)) as total_soma"),
                DB::raw("DATE_FORMAT(cao_fatura.data_emissao,'%m') as num_mes"))
//            ->select(DB::raw('cao_cliente.no_fantasia as nome_cliente'),DB::raw('(cao_fatura.valor - cao_fatura.total_imp_inc/100) as sums'),DB::raw("DATE_FORMAT(cao_fatura.data_emissao,'%m') as num_mes"))
            ->groupBy('cao_fatura.co_cliente')

            ->groupBy(DB::raw("DATE_FORMAT(cao_fatura.data_emissao,'%m') "))


            ->groupBy(function ($item){
                return $item->num_mes;
            });

            return $clientes;

    }

    public function dados_pizza($request){

        $pizza_clientes =  DB::table('cao_fatura')
            ->join('cao_cliente', function($join) use ($request)
            {
                $join->on('cao_fatura.co_cliente', '=','cao_cliente.co_cliente')
                    ->whereIn('cao_fatura.co_cliente', $request->clientes);
            })
            ->whereBetween('cao_fatura.data_emissao',[$request->date_inicio.'-01',$request->date_fim.'-01'])
            ->select(DB::raw('cao_cliente.no_fantasia as name'),DB::raw('(cao_fatura.valor - cao_fatura.total_imp_inc/100) as y'),DB::raw("DATE_FORMAT(cao_fatura.data_emissao,'%m') as num_mes"))
            ->orderBy('num_mes', 'asc')
            ->groupBy('name')
            ->get();

        return $pizza_clientes;
    }

    /**
     * Retorna uma Collection de Clientes
     * @return \Illuminate\Support\Collection
     */
    public function lista_clientes(){

         return DB::table('cao_cliente')
            ->where('tp_cliente', '=', 'A')
            ->select('no_fantasia', 'co_cliente')
            ->get();
    }

    /**
     * valida os dados submetidos sobre o formulario
     * @param $request
     */
    public function validador($request){

        $request->validate([
            'date_inicio' => 'required|date|after:date',
            'date_fim' => 'required|date|after:date_inicio',
            "clientes"    => "required|array|min:1",
            "clientes.*"  => "required|string|distinct|min:1"
        ]);
    }

    /**
     * Retorna um array de Meses
     * @param $request
     * @return \Illuminate\Support\Collection
     */
    public function meses(){

        return  [ "Janeiro", "Fevereiro", "Março", "Abril", "Maio", "junho", "julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro" ];

    }
}
