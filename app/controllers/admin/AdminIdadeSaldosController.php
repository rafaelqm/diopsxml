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

        
        // Show the page
        return View::make('admin/idadesaldos/index', compact('idadesaldos', 'title'));
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return IdadeSaldoonse
	 */
	public function getCreate()
	{
        // Title
        $title = 'Idade de Saldo';
        $tipos = array( 'A' => 'Ativo', 
                        'P' => 'Passivo'
                );

        // Show the page
        return View::make('admin/idadesaldos/create_edit', compact('title','tipos'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return IdadeSaldoonse
	 */
	public function postCreate()
	{

        if(Input::get('tipo')=='P'){
            $rules = array(
            'dias'              => 'required',
            'eventos'           => 'required',
            'comercial'         => 'required',
            'debOper'           => 'required',
            'outrosDebOper'     => 'required',
            'depBenConSegRec'   => 'required',
            'prestServAS'       => 'required',
            'depAquisCarre'     => 'required',
            'outrosDebPagar'    => 'required',
            'eventossus'        => 'required',
            'titulosencargos'   => 'required',
            'trimestre'         => 'required'
            );
        }else{
            // Declare the rules for the form validation
            $rules = array(
                'dias'              => 'required',
                'individualPre'     => 'required',
                'individualPos'     => 'required',
                'coletivoPre'       => 'required',
                'coletivoPos'       => 'required',
                'taxaAdm'           => 'required',
                'partBenefES'       => 'required',
                'credOper'          => 'required',
                'outrosCredComPlano'=> 'required',
                'outrosCredSemPlano'=> 'required',      
                'trimestre'         => 'required'      
            );
        }
        

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            // Create a new idadesaldo idadesaldo
            $user = Auth::user();

            if(Input::get('tipo')=='P'){
                $idadesaldo = IdadeSaldoPassivo::create(
                    array(
                        'dias'              => Input::get('dias'),
                        'eventos'           => Input::get('eventos'),
                        'comercial'         => Input::get('comercial'),
                        'debOper'           => Input::get('debOper'),
                        'outrosDebOper'     => Input::get('outrosDebOper'),
                        'depBenConSegRec'   => Input::get('depBenConSegRec'),
                        'prestServAS'       => Input::get('prestServAS'),
                        'depAquisCarre'     => Input::get('depAquisCarre'),
                        'outrosDebPagar'    => Input::get('outrosDebPagar'),
                        'eventossus'        => Input::get('eventossus'),
                        'titulosencargos'   => Input::get('titulosencargos'),
                        'trimestre'         => Input::get('trimestre')
                    )
                );

            }else{
                $idadesaldo = IdadeSaldoAtivo::create(
                    array(
                        'dias'                  => Input::get('dias'),
                        'individualPre'         => Input::get('individualPre'),
                        'individualPos'         => Input::get('individualPos'),
                        'coletivoPre'           => Input::get('coletivoPre'),
                        'coletivoPos'           => Input::get('coletivoPos'),
                        'taxaAdm'               => Input::get('taxaAdm'),
                        'partBenefES'           => Input::get('partBenefES'),
                        'credOper'              => Input::get('credOper'),
                        'outrosCredComPlano'    => Input::get('outrosCredComPlano'),
                        'outrosCredSemPlano'    => Input::get('outrosCredSemPlano'),
                        'trimestre'             => Input::get('trimestre')
                    )
                );
            }           

            
            // Was the idadesaldo idadesaldo created?
            if($idadesaldo)
            {
                // Redirect to the new idadesaldo idadesaldo page
                return Redirect::to('admin/idadesaldos/' . $idadesaldo->id . '/editar')->with('success', Lang::get('admin/idadesaldos/messages.create.success'));
            }

            // Redirect to the idadesaldo idadesaldo create page
            return Redirect::to('admin/idadesaldos/create')->with('error', Lang::get('admin/idadesaldos/messages.create.error'));
        }

        // Form validation failed
        return Redirect::to('admin/idadesaldos/create')->withInput()->withErrors($validator);
	}

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param $idadesaldo
     * @return IdadeSaldoonse
     */
	public function getEdit($idadesaldo)
	{
        // Title
        $title = Lang::get('admin/idadesaldos/title.idadesaldo_update');  

        // Show the page
        return View::make('admin/idadesaldos/create_edit', compact('idadesaldo', 'title'));
	}

    /**
     * Update the specified resource in storage.
     *
     * @param $idadesaldo
     * @return IdadeSaldoonse
     */
	public function postEdit($idadesaldo)
	{

        // Declare the rules for the form validation
        $rules = array(
            'tipo'          => 'required',
            'conta'         => 'required',
            'saldoAnterior' => 'required',
            'debito'        => 'required',
            'credito'       => 'required',
            'saldoFinal'    => 'required'          
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            // Update the idadesaldo idadesaldo data
            $idadesaldo->tipo            = Input::get('tipo');
            $idadesaldo->conta           = Input::get('conta');
            $idadesaldo->contaTasy       = Input::get('contaTasy');
            $idadesaldo->descricao       = Input::get('descricao');
            $idadesaldo->saldoAnterior   = DataFormat::moneyBD( Input::get('saldoAnterior',0) );
            $idadesaldo->debito          = DataFormat::moneyBD( Input::get('debito',0) );
            $idadesaldo->credito         = DataFormat::moneyBD( Input::get('credito',0) );
            $idadesaldo->saldoFinal      = DataFormat::moneyBD( Input::get('saldoFinal',0) );
            $idadesaldo->inicioPeriodo   = date('Y-m-d');
            $idadesaldo->trimestre       = Input::get('trimestre');

            $salvo = $idadesaldo->save();

            // Was the idadesaldo idadesaldo updated?
            if($salvo)
            {
                // Redirect to the new idadesaldo idadesaldo page
                return Redirect::to('admin/idadesaldos/' . $idadesaldo->id . '/editar')->with('success', Lang::get('admin/idadesaldos/messages.update.success'));
            }

            // Redirect to the idadesaldos idadesaldo management page
            return Redirect::to('admin/idadesaldos/' . $idadesaldo->id . '/editar')->with('error', Lang::get('admin/idadesaldos/messages.update.error'));
        }

        // Form validation failed
        return Redirect::to('admin/idadesaldos/' . $idadesaldo->id . '/editar')->withInput()->withErrors($validator);
	}


    /**
     * Remove the specified resource from storage.
     *
     * @param $idadesaldo
     * @return IdadeSaldoonse
     */
    public function getDelete($idadesaldo)
    {
        // Title
        $title = Lang::get('admin/idadesaldos/title.idadesaldo_delete');

        // Show the page
        return View::make('admin/idadesaldos/delete', compact('idadesaldo', 'title'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $idadesaldo
     * @return IdadeSaldoonse
     */
    public function postDelete($idadesaldo)
    {
        // Declare the rules for the form validation
        $rules = array(
            'id' => 'required|integer'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            $id = $idadesaldo->id;
            $idadesaldo->delete();

            // Was the idadesaldo idadesaldo deleted?
            $idadesaldo = IdadeSaldo::find($id);
            if(empty($idadesaldo))
            {
                // Redirect to the idadesaldo idadesaldos management page
                return Redirect::to('admin/idadesaldos')->with('success', Lang::get('admin/idadesaldos/messages.delete.success'));
            }
        }
        // There was a problem deleting the idadesaldo idadesaldo
        return Redirect::to('admin/idadesaldos')->with('error', Lang::get('admin/idadesaldos/messages.delete.error'));
    }

    /**
     * Show a list of all the idadesaldo idadesaldos formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData($tipo = null)
    {
        if(! is_null($tipo)){
            Session::put('tipo', $tipo);
        }

        if(! Session::has('tipo')){
            Session::put('tipo', 'A');
        }
        $idadesaldos = IdadeSaldo::select(
                        array(
                            'id', 
                            'conta', 
                            'descricao', 
                            'saldoAnterior',
                            'debito', 
                            'credito',  
                            'saldoFinal'
                        )
                    )
                    ->where('tipo','=', Session::get('tipo') )
                    ->where('trimestre','=',Session::get('trimestre') );

        return Datatables::of($idadesaldos)

        // ->edit_column('tipoPessoa', '@if($tipoPessoa == \'J\') Jurídica @else Física @endif')
        ->edit_column('saldoAnterior', '{{ DataFormat::moneyBR( $saldoAnterior ) }}')
        ->edit_column('debito', '{{ DataFormat::moneyBR( $debito ) }}')
        ->edit_column('credito', '{{ DataFormat::moneyBR( $credito ) }}')
        ->edit_column('saldoFinal', '{{ DataFormat::moneyBR( $saldoFinal ) }}')

        ->add_column('actions', '<a href="{{{ URL::to(\'admin/idadesaldos/\' . $id . \'/editar\' ) }}}" class="btn btn-default btn-xs iframe" >{{{ Lang::get(\'button.edit\') }}}</a> <a href="{{{ URL::to(\'admin/idadesaldos/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger iframe">{{{ Lang::get(\'button.delete\') }}}</a>')
                
        ->remove_column('id')

        ->make();
    }

}