<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConsultorController extends Controller
{
    /**
     * Recebe o Request, Lista dos consultores, data inicio e data fim.
     * E em funcao disso, retorna, o relatorio, a pizza , ou grafico ou uma pagina "none"
     * caso nao seja nenhuma das 3 opcoes
     */
    public function con_desempenho_sub(Request $request)
    {
        $date_inicio = $request->date_inicio;
        $date_fim = $request->date_fim;

        if ($request->submitAction == "relatorio"){

            $lista_mes = $this->meses();

            $rel_consultores = $this->rel_consultores($request);
//             $this->rel_consultores($request);
//
            return view('consultor.relatorio',compact('rel_consultores','lista_mes','date_inicio','date_fim'));

        }elseif ($request->submitAction == "pizza"){

            $resul_pizza = $this->consultor_pizza();

            return view('consultor.consultor_pizza',compact('resul_pizza','date_inicio','date_fim'));

        }elseif ($request->submitAction == "grafico"){

            $consultores = $this->consultor_graf();

            return view('consultor.consultor_graf',compact('consultores','date_inicio','date_fim'));

        }else{

            view('pagina_none');

        }

    }

    public function con_desempenho()
    {
        $date_inicio = '2007-01';
        $date_fim = '2007-12';
        $consultores =  DB::table('cao_usuario')
            ->join('permissao_sistema', function($join)
            {
                $join->on('cao_usuario.co_usuario', '=','permissao_sistema.co_usuario')
                    ->where('permissao_sistema.co_sistema', '=', 1)
                    ->where('permissao_sistema.in_ativo', '=', 'S')
                    ->whereIn('permissao_sistema.co_tipo_usuario', array(1, 2, 3));
            })
            ->select('cao_usuario.co_usuario', 'cao_usuario.no_usuario')
            ->get();

        return view('consultor.con_desempenho',compact('consultores', 'date_inicio','date_fim'));

    }

    /**
     * Retorna uma lista, de dados de consultores. (De modo a gerar o relatorio)
     * @param $request
     * @return \Illuminate\Support\Collection
     */
    public function rel_consultores($request){

        $consultores = $request->consultores;
        $date_inicio = $request->date_inicio.'-01';
        $date_fim = $request->date_fim.'-01';

//        $consultores = $request->consultores;
//        $date_inicio = $request->date_inicio.'-01';
//        $date_fim = $request->date_fim.'-01';
        $rel_consultores =  DB::table('cao_fatura')
            ->join('cao_os', function($join) use ($consultores)
            {
                $join->on('cao_fatura.co_os', '=','cao_os.co_os')
                    //TODO
                    ->whereIn('cao_os.co_usuario', $consultores);
            })
            ->join('cao_usuario', 'cao_usuario.co_usuario', '=', 'cao_os.co_usuario')
            ->join('cao_salario', 'cao_salario.co_usuario', '=', 'cao_os.co_usuario')
            ->whereBetween('cao_fatura.data_emissao',['2007-01-01','2007-05-25'])
            ->select(DB::raw('cao_fatura.valor as valor'),
                DB::raw('cao_fatura.co_os as co_os'),
                DB::raw('cao_salario.brut_salario as custo_fixo'),
                DB::raw('cao_usuario.no_usuario as nome_usuario'),
                DB::raw('(cao_fatura.valor - cao_fatura.total_imp_inc/100) as receita_líquida'),
                DB::raw('(cao_fatura.valor*cao_fatura.total_imp_inc/100*comissao_cn/100) as comissao'),
//                DB::raw('(receita_líquida as lucro'),
                DB::raw("DATE_FORMAT(cao_fatura.data_emissao,'%y') as ano"),
                DB::raw("DATE_FORMAT(cao_fatura.data_emissao,'%m') as num_mes"))
            ->orderBy('num_mes', 'asc')
            ->groupBy('num_mes','cao_usuario.no_usuario')
            ->get()
            ->groupBy(function ($item){
                return $item->nome_usuario;
            })
//            ->orderBy('cao_os.co_usuario', 'asc')
//            ->orderBy('cao_fatura.data_emissao')
//            ->get()
        ;

          return $rel_consultores;
//        return view('consultor.relatorio',compact('rel_consultores','lista_mes'));
//        dd($rel_consultores);
    }
    /**
     * Retorna uma lista, de dados de consultores. (De modo a gerar o Grafico)
     * @param $request
     * @return \Illuminate\Support\Collection
     */
    public function consultor_graf(){

        $consultores =  DB::table('cao_fatura')
            ->join('cao_os', function($join)
            {
                $join->on('cao_fatura.co_os', '=','cao_os.co_os')
                    ->whereIn('cao_os.co_usuario', array('carlos.carvalho', 'carlos.arruda','luiz.paulo','marco.malaquias'));
            })
            ->whereBetween('cao_fatura.data_emissao',['2007-01-25','2007-03-25'])
            ->orderBy('cao_os.co_usuario', 'asc')
            ->orderBy('cao_fatura.data_emissao')
            ->get();

          return $consultores;

    }
    /**
     * Retorna uma lista, de dados de consultores. (De modo a gerar a Pizza)
     * @param $request
     * @return \Illuminate\Support\Collection
     */
    public function consultor_pizza(){

        $resul_pizza =  DB::table('cao_fatura')
            ->join('cao_os', function($join)
            {
                $join->on('cao_fatura.co_os', '=','cao_os.co_os')
                    ->whereIn('cao_os.co_usuario', array('carlos.carvalho', 'carlos.arruda','luiz.paulo','marco.malaquias'));
            })
            ->whereBetween('cao_fatura.data_emissao',['2007-01-25','2007-03-25'])
            ->orderBy('cao_os.co_usuario', 'asc')
            ->select(DB::raw('cao_os.co_usuario as name,(cao_fatura.valor - cao_fatura.total_imp_inc/100) as y'))
            ->groupBy('cao_os.co_usuario')
            ->get();

        return  $resul_pizza;

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
