<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConsultorController extends Controller
{
    /**
     * Recebe o Request, Lista dos consultores, data inicio e data fim.
     *
     */
    public function con_desempenho_sub(Request $request)
    {
        if ($request->submitAction == "relatorio"){

            $this->get_rel_clientes();

        }elseif ($request->submitAction == "pizza"){


            $this->consultor_pizza();

        }elseif ($request->submitAction == "grafico"){

            $this->consultor_graf();

        }else{

            view('pagina_none');

        }

    }

    public function con_desempenho()
    {
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

        return view('consultor.con_desempenho',compact('consultores'));
//dd($consultores);
    }

    public function get_rel_clientes()
    {
        $consultores =  DB::table('cao_fatura')
            ->join('cao_os', function($join)
            {
                $join->on('cao_fatura.co_os', '=','cao_os.co_os')
                    //TODO
                    ->whereIn('cao_os.co_usuario', array('carlos.carvalho', 'carlos.arruda','luiz.paulo','marco.malaquias'));
            })
            ->whereBetween('cao_fatura.data_emissao',['2007-01-25','2007-03-25'])
            ->orderBy('cao_os.co_usuario', 'asc')
            ->orderBy('cao_fatura.data_emissao')
            ->get();
        return view('consultores',compact('consultores'));
//        dd($consultores);
    }

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

        return view('consultor.consultor_graf',compact('consultores'));
//        dd($consultores);
    }

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

        return view('consultor.consultor_pizza',compact('resul_pizza'));
//        dd($resul_pizza);
    }
}
