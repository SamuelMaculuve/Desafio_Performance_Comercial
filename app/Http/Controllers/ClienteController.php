<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    /**
     * Retorna a lista dos Lista de Consultores.
     *
     */
    public function con_desempenho_sub(Request $request)
    {

        dd($request->basic);
       // return view('consultor.con_desempenho',compact('consultores'));

    }
    public function listar_clientes()
    {
        $clientes =  DB::table('cao_cliente')
            ->where('tp_cliente', '=', 'A')
            ->select('no_fantasia', 'co_cliente')
            ->get();
        return view('cliente.con_desempenho',compact('clientes'));
//dd($clientes);
    }

    public function relatorio()
    {
        $relatorio_clientes =  DB::table('cao_fatura')
            ->join('cao_cliente', function($join)
            {
                $join->on('cao_fatura.co_cliente', '=','cao_cliente.co_cliente');
//                    ->whereIn('cao_fatura.co_cliente', array(6947,3,5,4,2));
            })
            ->whereBetween('cao_fatura.data_emissao',['2007-01-01','2007-05-31'])
            ->select(DB::raw('cao_cliente.no_fantasia as nome_cliente'),DB::raw('(cao_fatura.valor - cao_fatura.total_imp_inc/100) as sums'),DB::raw("DATE_FORMAT(cao_fatura.data_emissao,'%m') as num_mes"))
            ->orderBy('num_mes', 'asc')
//            ->orderBy('cao_cliente.no_fantasia', 'asc')
            ->groupBy('num_mes','cao_fatura.co_cliente')
            ->paginate(15)
            ->groupBy(function ($item){
                return $item->nome_cliente;
            })
        ;

         return view('cliente.relatorio',compact('relatorio_clientes'));


    }

    public function dados_grafico(){

        $consultores =  DB::table('cao_fatura')
            ->join('cao_cliente', function($join)
            {
                $join->on('cao_fatura.co_cliente', '=','cao_cliente.co_cliente');
//                    ->whereIn('cao_fatura.co_cliente', array(6947,3,5,4,2));
            })
            ->whereBetween('cao_fatura.data_emissao',['2007-01-01','2007-12-31'])
            ->select(DB::raw('cao_cliente.no_fantasia as nome'),DB::raw('sum(cao_fatura.valor) as sums'),DB::raw("DATE_FORMAT(cao_fatura.data_emissao,'%m') as months"))

            ->orderBy('cao_cliente.no_fantasia', 'asc')
            ->groupBy('months','cao_fatura.co_cliente')
            ->sum('sums as sum1')
            //            ->orderBy('cao_fatura.data_emissao')
            ->get();

        return view('cliente.grafico',compact('consultores'));

    }

    public function dados_pizza(){

        $pizza_clientes =  DB::table('cao_fatura')
            ->join('cao_cliente', function($join)
            {
                $join->on('cao_fatura.co_cliente', '=','cao_cliente.co_cliente');
//                    ->whereIn('cao_fatura.co_cliente', array(6947,3,5,4,2));
            })
            ->whereBetween('cao_fatura.data_emissao',['2007-01-01','2007-05-31'])
            ->select(DB::raw('cao_cliente.no_fantasia as name'),DB::raw('(cao_fatura.valor - cao_fatura.total_imp_inc/100) as y'),DB::raw("DATE_FORMAT(cao_fatura.data_emissao,'%m') as num_mes"))
            ->orderBy('num_mes', 'asc')
            ->groupBy('name')
            ->get();

        return view('cliente.pizza',compact('pizza_clientes'));
//        dd($pizza_clientes);
    }
}
