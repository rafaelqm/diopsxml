<?php

class AdminIdadeSaldosController extends BaseController {

    /**
     * Show a list of all the idadesaldo idadesaldos.
     *
     * @return View
     */
    public function getIndex()
    {
        if(! Session::has('tipo')){
            Session::put('tipo', 'A');
        }
        // Title
        $title = 'Idade de Saldos';

        $IdadeSaldoAtivo = IdadeSaldoAtivo::where('trimestre','=', Session::get('trimestre'))
                                ->get();
        if(count($IdadeSaldoAtivo)==0){
            // Inserir 
            $array_dias = array(
                0       => 'a Vencer',
                30      => 'Vencidos de 1 a 30 dias',
                60      => 'Vencidos de 31 a 60 dias',
                90      => 'Vencidos de 61 a 90 dias',
                366     => 'Vencidos a mais de 90 dias',
                800     => 'Subtotal',
                801     => '(-)Faturamento Antecipado',
                830     => '(-)PPSC',
                9999    => 'SALDO',
            );
            foreach ($array_dias as $dia => $descricao) { 
                $idad_saldo_atv = IdadeSaldoAtivo::create(
                    array(
                        'dias' => $dia,
                        'individualPre' => 0,
                        'individualPos' => 0,
                        'coletivoPre' => 0,
                        'coletivoPos' => 0,
                        'taxaAdm' => 0,
                        'partBenefES' => 0,
                        'credOper' => 0,
                        'outrosCredComPlano' => 0,
                        'outrosCredSemPlano' => 0,
                        'trimestre' => Session::get('trimestre'),
                    )
                );
            }
            $IdadeSaldoAtivo = IdadeSaldoAtivo::where('trimestre','=', Session::get('trimestre'))
                                ->get();
        }

        
        

        $IdadeSaldoPassivo = IdadeSaldoPassivo::where('trimestre','=', Session::get('trimestre'))
                                ->get();

        if(count($IdadeSaldoPassivo)==0){
            // Inserir 
            $array_dias_passivo = array(
                0       => 'a Vencer',
                30      => 'Vencidos de 1 a 30 dias',
                60      => 'Vencidos de 31 a 60 dias',
                90      => 'Vencidos de 61 a 90 dias',
                120     => 'Vencidos de 91 a 120 dias',
                366     => 'Vencidos a mais de 120 dias',
                9999    => 'SALDO',
            );
            foreach ($array_dias_passivo as $dia => $descricao) { 
                $idad_saldo_psv = IdadeSaldoPassivo::create(
                    array(
                        'dias'              => $dia,
                        'eventos'           => 0,
                        'comercial'         => 0,
                        'debOper'           => 0,
                        'outrosDebOper'     => 0,
                        'depBenConSegRec'   => 0,
                        'prestServAS'       => 0,
                        'depAquisCarre'     => 0,
                        'outrosDebPagar'    => 0,
                        'eventossus'        => 0,
                        'titulosencargos'   => 0,
                        'trimestre'         => Session::get('trimestre'),
                    )
                );
            }
            $IdadeSaldoPassivo = IdadeSaldoPassivo::where('trimestre','=', Session::get('trimestre'))
                                ->get();
        }

        


        // Show the page
        return View::make('admin/idadesaldos/index', compact('idadesaldos', 'title','IdadeSaldoAtivo','IdadeSaldoPassivo'));
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

        $campoXtbl = array(
                        'eventos'           => 'IdadeSaldoPassivo',
                        'comercial'         => 'IdadeSaldoPassivo',
                        'debOper'           => 'IdadeSaldoPassivo',
                        'outrosDebOper'     => 'IdadeSaldoPassivo',
                        'depBenConSegRec'   => 'IdadeSaldoPassivo',
                        'prestServAS'       => 'IdadeSaldoPassivo',
                        'depAquisCarre'     => 'IdadeSaldoPassivo',
                        'outrosDebPagar'    => 'IdadeSaldoPassivo',
                        'eventossus'        => 'IdadeSaldoPassivo',
                        'titulosencargos'   => 'IdadeSaldoPassivo',
                        'individualPre'         => "IdadeSaldoAtivo",
                        'individualPos'         => "IdadeSaldoAtivo",
                        'coletivoPre'           => "IdadeSaldoAtivo",
                        'coletivoPos'           => "IdadeSaldoAtivo",
                        'taxaAdm'               => "IdadeSaldoAtivo",
                        'partBenefES'           => "IdadeSaldoAtivo",
                        'credOper'              => "IdadeSaldoAtivo",
                        'outrosCredComPlano'    => "IdadeSaldoAtivo",
                        'outrosCredSemPlano'    => "IdadeSaldoAtivo",
                    );
        

        $valor = DataFormat::moneyBD(Input::get('valor'));

        $atualizar = $campoXtbl[$campo]::find($id);

        $atualizar->$campo = $valor;

        $atualizado = $atualizar->save();

        # atualizar saldo e subtotal* (caso houver)
        $soma_saldo = 0;
        $soma_subtotal = 0;

        $atualizar_subtotal = null;

        if($campoXtbl[$campo]=='IdadeSaldoPassivo'){
            $tipo = 'passivo';
            $atualizar_saldo = IdadeSaldoPassivo::where('trimestre','=',$atualizar->trimestre)
                                ->where('dias','=',9999)->first();


            $soma_saldo = DB::table('idadesaldopassivos')->where('trimestre','=',$atualizar->trimestre)
                                ->where('dias','!=',9999)->sum($campo);

            $atualizar_saldo->$campo = $soma_saldo;

            $salva_saldo = $atualizar_saldo->save();
            
        }else{
            $tipo = 'ativo';
            # IdadeSaldoAtivo
            // 800     => 'Subtotal',

            $atualizar_subtotal = IdadeSaldoAtivo::where('trimestre','=',$atualizar->trimestre)
                                ->where('dias','=',800)->first();


            $soma_subtotal = DB::table('idadesaldoativos')->where('trimestre','=',$atualizar->trimestre)
                                ->where('dias','<',800)->sum($campo);

            $atualizar_subtotal->$campo = $soma_subtotal;

            $salva_subtotal = $atualizar_subtotal->save();

            // 9999    => 'SALDO',
            $atualizar_saldo = IdadeSaldoAtivo::where('trimestre','=',$atualizar->trimestre)
                                ->where('dias','=',9999)->first();


            $soma_saldo = DB::table('idadesaldoativos')->where('trimestre','=',$atualizar->trimestre)
                                ->where('dias','!=',9999)->where('dias','!=',800)->sum($campo);

            $atualizar_saldo->$campo = $soma_saldo;

            $salva_saldo = $atualizar_saldo->save();

        }

        return Response::json(array('atualizado'=>$atualizado,
                                    'saldo'=>DataFormat::moneyBR( $soma_saldo ),
                                    'subtotal'=>DataFormat::moneyBR($soma_subtotal),
                                    'tipo'=>$tipo,
                                    'campo'=>$campo,
                                    'id'=>$id,
                                    'id_saldo'=>$atualizar_saldo->id,
                                    'id_subtotal'=> (is_null($atualizar_subtotal)? null : $atualizar_subtotal->id)
                                )
        );
        
	}

}