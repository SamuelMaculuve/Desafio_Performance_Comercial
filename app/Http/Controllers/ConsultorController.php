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
        $this->validador($request);

        $lista_consultores = $this->consultores_lista();

        $consultores_activos = $this->consultores_lista_por_co_usuario($request->consultores);

        $consultores = $lista_consultores->diffKeys($consultores_activos);

        //colocando os dados na sessao
        \Session::put('date_inicio_activo', $request->date_inicio);
        \Session::put('date_fim_activo', $request->date_fim);

        if ($request->submitAction == "relatorio"){

            $lista_mes = $this->meses();

            $rel_consultores = $this->rel_consultores($request);

            return view('consultor.relatorio',compact('rel_consultores','lista_mes','consultores','consultores_activos'));

        }elseif ($request->submitAction == "pizza"){

            $resul_pizza = $this->consultor_pizza($request);

            return view('consultor.consultor_pizza',compact('resul_pizza','consultores','consultores_activos'));

        }elseif ($request->submitAction == "grafico"){
                // TODO, problemas em colocar os valores x e y no grfico.
            $resul_grafico = json_encode($this->consultor_graf($request)->groupBy(function ($item){
                return $item->w;
            }));
            $resul_grafico1 = $this->consultor_graf($request);

            return view('consultor.consultor_graf',compact('resul_grafico','consultores','consultores_activos'));

        }else{

            view('pagina_none');

        }

    }

    public function con_desempenho()
    {
        $consultores_activos = [];
        $consultores =  $this->consultores_lista();

        return view('consultor.con_desempenho',compact('consultores', 'consultores_activos'));

    }

    /**
     * Retorna uma lista, de dados de consultores. (De modo a gerar o relatorio)
     * @param $request
     * @return \Illuminate\Support\Collection
     */
    public function rel_consultores($request){

        $rel_consultores =  DB::table('cao_fatura')
            ->join('cao_os', function($join) use ($request)
            {
                $join->on('cao_fatura.co_os', '=','cao_os.co_os')
                    //TODO
                    ->whereIn('cao_os.co_usuario', $request->consultores);
            })
            ->join('cao_usuario', 'cao_usuario.co_usuario', '=', 'cao_os.co_usuario')
            ->join('cao_salario', 'cao_salario.co_usuario', '=', 'cao_os.co_usuario')
            ->whereBetween('cao_fatura.data_emissao',[$request->date_inicio.'-01',$request->date_fim.'-01'])
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
        ;

          return $rel_consultores;
    }
    /**
     * Retorna uma lista, de dados de consultores. (De modo a gerar o Grafico)
     * @param $request
     * @return \Illuminate\Support\Collection
     */
    public function consultor_graf($request){

        $rel_consultores =  DB::table('cao_fatura')
            ->join('cao_os', function($join) use ($request)
            {
                $join->on('cao_fatura.co_os', '=','cao_os.co_os')
                    //TODO
                    ->whereIn('cao_os.co_usuario', $request->consultores);
            })
            ->join('cao_usuario', 'cao_usuario.co_usuario', '=', 'cao_os.co_usuario')
            ->join('cao_salario', 'cao_salario.co_usuario', '=', 'cao_os.co_usuario')
            ->whereBetween('cao_fatura.data_emissao',[$request->date_inicio.'-01',$request->date_fim.'-01'])
            ->select(
                DB::raw("cao_fatura.data_emissao as x"),
                DB::raw('cao_fatura.valor as y'),
                DB::raw("DATE_FORMAT(cao_fatura.data_emissao,'%m') as w"))
            ->orderBy('w', 'asc')
//            ->makeHidden(['w'])
            ->groupBy('w','cao_usuario.no_usuario')
            ->get()

                ;

//          return $rel_consultores->toArray();
            return $rel_consultores;

    }
    public function consultor_graf1($request){

        $consultores =  DB::table('cao_fatura')
            ->join('cao_os', function($join) use ($request)
            {
                $join->on('cao_fatura.co_os', '=','cao_os.co_os')
                    ->whereIn('cao_os.co_usuario', $request->consultores);
            })
            ->join('cao_usuario', 'cao_usuario.co_usuario', '=', 'cao_os.co_usuario')
            ->whereBetween('cao_fatura.data_emissao',[$request->date_inicio.'-01',$request->date_fim.'-01'])
            ->select(DB::raw("DATE_FORMAT(,'%m') as x"))
            ->select(DB::raw("SUM(cao_fatura.valor - (cao_fatura.total_imp_inc/100)) as y, MONTH( cao_fatura.data_emissao ) as x,cao_os.co_usuario"))
            ->orderBy('cao_usuario.no_usuario', 'asc')
            ->groupBy('x','cao_usuario.no_usuario')
            ->get()
            ->groupBy(DB::raw('total_soma ASC'));

        return $consultores->toArray();

    }
    /**
     * Retorna uma lista, de dados de consultores. (De modo a gerar a Pizza)
     * @param $request
     * @return \Illuminate\Support\Collection
     */

    public function consultor_pizza($request){

        $resul_pizza =  DB::table('cao_fatura')
            ->join('cao_os', function($join) use ($request)
            {
                $join->on('cao_fatura.co_os', '=','cao_os.co_os')
                    ->whereIn('cao_os.co_usuario', $request->consultores );
            })
            ->whereBetween('cao_fatura.data_emissao',[$request->date_inicio.'-01',$request->date_fim.'-01'])
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

    /** Retorna a Collection dos consultores
     * @return \Illuminate\Support\Collection
     */
    public function consultores_lista()
    {
        $consultores =  DB::table('cao_usuario')
            ->join('permissao_sistema', function($join)
            {
                $join->on('cao_usuario.co_usuario', '=','permissao_sistema.co_usuario')
                    ->where('permissao_sistema.co_sistema', '=', 1)
                    ->where('permissao_sistema.in_ativo', '=', 'S')
                    ->whereIn('permissao_sistema.co_tipo_usuario', array(0, 1, 2));
            })
            ->select('cao_usuario.co_usuario', 'cao_usuario.no_usuario')
            ->orderBy('cao_usuario.co_usuario')
            ->get();

            return $consultores;
    }

    public function consultores_lista_por_co_usuario($consultores)
    {
        $consultores =  DB::table('cao_usuario')
            ->join('permissao_sistema', function($join) use ($consultores)
            {
                $join->on('cao_usuario.co_usuario', '=','permissao_sistema.co_usuario')
                    ->where('permissao_sistema.co_sistema', '=', 1)
                    ->where('permissao_sistema.in_ativo', '=', 'S')
                    ->whereIn('permissao_sistema.co_tipo_usuario', array(0, 1, 2))
                    ->whereIn('cao_usuario.co_usuario', $consultores);
            })
            ->select('cao_usuario.co_usuario', 'cao_usuario.no_usuario')
            ->orderBy('cao_usuario.co_usuario')
            ->get();

        return $consultores;
    }

    /**
     * valida os dados submetidos sobre o formulario
     * @param $request
     */
    public function validador($request){

        $request->validate([
            'date_inicio' => 'required|date|after:date',
            'date_fim' => 'required|date|after:date_inicio',
            "consultores"    => "required|array|min:1",
            "consultores.*"  => "required|string|distinct|min:1"
        ]);
    }
}
