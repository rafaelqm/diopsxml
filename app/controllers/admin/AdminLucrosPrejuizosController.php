<?php

class AdminLucrosPrejuizosController extends BaseController {

    /**
     * Show a list of all the idadesaldo lucrosprejuizos.
     *
     * @return View
     */
    public function getIndex()
    {
        
        // Title
        $title = 'Lista de Lucros/Sobras/Superávits ou Prejuízos/Perdas/Déficits';

        $LucrosPrejuizos = LucroPrejuizo::where('trimestre','=', Session::get('trimestre'))
                                ->get();
        if(count($LucrosPrejuizos)==0){
            // Inserir 
            $array_desc = array(
                'AJUSTE_EXERCICIOS_ANTERIORES'    => 'Ajustes de exercícios anteriores (com sinal)',
                'CONSTITUICAO_RESERVAS'           => 'Constituição de reservas (-)',
                'JUROS_CAPITAL_PROPRIO'           => 'Juros sobre capital próprio (-)',
                'LUCROS_DISTRIBUIDOS'             => 'Lucros distribuidos (-)',
                'LUCRO_INCORPORADO_CAPITAL'       => 'Lucro incorporado ao capital (-)',
                'OUTROS'                          => 'Outros (com sinal)',
                'RESULTADO_PERIODO'               => 'Resultado do Período (com sinal)',
                'REVERSAO_RESERVAS'               => 'Reversão de reservas (+)',
                'TOTAL'                           => 'Total',
            );
            foreach ($array_desc as $conta => $descricao) { 
                $idad_saldo_atv = LucroPrejuizo::create(
                    array(
                        'conta' => $conta,
                        'valor' => 0,
                        'descricao' => $descricao,
                        'trimestre' => Session::get('trimestre'),
                    )
                );
            }
            $LucrosPrejuizos = LucroPrejuizo::where('trimestre','=', Session::get('trimestre'))
                                ->get();
        }
        


        // Show the page
        return View::make('admin/lucrosprejuizos/index', compact('title','LucrosPrejuizos'));
    }
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return IdadeSaldoonse
	 */
	public function getAlteravalor()
	{

        $name_array = explode('_', Input::get('name'));

        $id = $name_array[1];
        $campo = $name_array[0];    

        $valor = DataFormat::moneyBD(Input::get('valor'));

        $atualizar = LucroPrejuizo::find($id);

        $atualizar->valor = $valor;

        $atualizado = $atualizar->save();

        # atualizar total
        $total = 0;
        
        $atualizar_total = LucroPrejuizo::where('trimestre','=',$atualizar->trimestre)
                            ->where('conta','=','TOTAL')->first();


        $total = DB::table('lucrosprejuizos')->where('trimestre','=',$atualizar->trimestre)
                            ->where('conta','!=','TOTAL')->sum($campo);

        $atualizar_total->valor = $total;

        $salva_saldo = $atualizar_total->save();
        

        return Response::json(array('atualizado'=>$atualizado,
                                    'total'=>DataFormat::moneyBR( $total ),
                                    'id'=>$id,
                                    'id_total'=>$atualizar_total->id
                                )
        );
        
	}

}