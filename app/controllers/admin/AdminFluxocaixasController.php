<?php

class AdminFluxocaixasController extends BaseController {

	
    /**
     * FluxoCaixa Model
     * @var FluxoCaixa
     */
    protected $fluxocaixa;

    /**
     * Inject the models.
     * @param FluxoCaixa $fluxocaixa
     */
    public function __construct(FluxoCaixa $fluxocaixa)
    {
        parent::__construct();
        $this->fluxocaixa = $fluxocaixa;
    }

    /**
     * Show a list of all the fluxocaixa fluxocaixas.
     *
     * @return View
     */
    public function getIndex()
    {
        if(! Session::has('tipo')){
            Session::put('tipo', 'A');
        }
        // Title
        $title = Lang::get('admin/fluxocaixas/title.fluxocaixa_management');

        // Grab all the fluxocaixa fluxocaixas
        $fluxocaixas = $this->fluxocaixa->get();

        // Show the page
        return View::make('admin/fluxocaixas/index', compact('fluxocaixas', 'title'));
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return response
	 */
	public function getCreate()
	{
        // Title
        $title = Lang::get('admin/fluxocaixas/title.create_a_new_fluxocaixa');
        /*$tipos = array( 'A' => 'Ativo', 
                        'P' => 'Passivo', 
                        'R' => 'Receita', 
                        'D' => 'Despesa'
                );*/

        // Show the page
        return View::make('admin/fluxocaixas/create_edit', compact('title'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return FluxoCaixaonse
	 */
	public function postCreate()
	{
        // Declare the rules for the form validation
       
        $rules = array(
            'mes_num'       => 'required',
            'conta'         => 'required',
            'descricao'     => 'required',
            'valor'         => 'required'      
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            // Create a new fluxocaixa fluxocaixa
            $user = Auth::user();

            $descricao  = Input::get('descricao');
            $valor      = Input::get('valor');
            $salvo = 0;
            foreach (Input::get('conta') as $chave => $conta) {
                $fluxoCaixaNovo = FluxoCaixa::create(
                        array(
                            'conta'        => $conta,
                            'sequencia'    => $chave,
                            'descricao'    => $descricao[$chave],
                            'valor'        => DataFormat::moneyBD( $valor[$chave] ),
                            'trimestre'    => Session::get('trimestre'),
                            'mes_num'      => Input::get('mes_num')
                        )
                    );
                
                $salvo += isset($fluxoCaixaNovo);
            }
            

            // Was the fluxocaixa fluxocaixa created?
            if($salvo)
            {
                // Redirect to the new fluxocaixa fluxocaixa page
                return Redirect::to('admin/fluxocaixas/' . Input::get('mes_num') . '/editar')->with('success', Lang::get('admin/fluxocaixas/messages.create.success'));
            }

            // Redirect to the fluxocaixa fluxocaixa create page
            return Redirect::to('admin/fluxocaixas/create')->with('error', Lang::get('admin/fluxocaixas/messages.create.error'));
        }

        // Form validation failed
        return Redirect::to('admin/fluxocaixas/create')->withInput()->withErrors($validator);
	}


    /**
     * Show the form for editing the specified resource.
     *
     * @param $fluxocaixa
     * @return FluxoCaixaonse
     */
	public function getEdit($mes_num)
	{
        // Title
        $title = Lang::get('admin/fluxocaixas/title.fluxocaixa_update');  

        $fluxocaixas = FluxoCaixa::where('mes_num','=',$mes_num)
                                ->where('trimestre','=',Session::get('trimestre'))
                                ->get();

        // Show the page
        return View::make('admin/fluxocaixas/create_edit', compact('fluxocaixas', 'title', 'mes_num'));
	}

    /**
     * Update the specified resource in storage.
     *
     * @param $fluxocaixa
     * @return FluxoCaixaonse
     */
	public function postEdit($fluxocaixa)
	{

        // Declare the rules for the form validation
        $rules = array(
            'mes_num'       => 'required',
            'conta'         => 'required',
            'descricao'     => 'required',
            'valor'         => 'required'      
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            $descricao  = Input::get('descricao');
            $valor      = Input::get('valor');
            $id      = Input::get('id');
            $salvo = 0;
            foreach (Input::get('conta') as $chave => $conta) {
                $salvo += DB::table('fluxoCaixas')
                    ->where('id','=',$id[$chave])
                    ->update(array(
                            'conta'        => $conta,
                            'sequencia'    => $chave,   
                            'descricao'    => $descricao[$chave],
                            'valor'        => DataFormat::moneyBD( $valor[$chave] ),
                            'trimestre'    => Session::get('trimestre'),
                            'mes_num'      => Input::get('mes_num')
                        ));                 
            }

            // Was the fluxocaixa fluxocaixa updated?
            if($salvo)
            {
                // Redirect to the new fluxocaixa fluxocaixa page
                return Redirect::to('admin/fluxocaixas/' . Input::get('mes_num') . '/editar')->with('success', Lang::get('admin/fluxocaixas/messages.update.success'));
            }

            // Redirect to the fluxocaixas fluxocaixa management page
            return Redirect::to('admin/fluxocaixas/' . Input::get('mes_num') . '/editar')->with('error', Lang::get('admin/fluxocaixas/messages.update.error'));
        }

        // Form validation failed
        return Redirect::to('admin/fluxocaixas/' . Input::get('mes_num') . '/editar')->withInput()->withErrors($validator);
	}


    /**
     * Remove the specified resource from storage.
     *
     * @param $fluxocaixa
     * @return FluxoCaixaonse
     */
    public function getDelete($fluxocaixa)
    {
        // Title
        $title = Lang::get('admin/fluxocaixas/title.fluxocaixa_delete');

        // Show the page
        return View::make('admin/fluxocaixas/delete', compact('fluxocaixa', 'title'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $fluxocaixa
     * @return FluxoCaixaonse
     */
    public function postDelete($fluxocaixa)
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
            $id = $fluxocaixa->id;
            $fluxocaixa->delete();

            // Was the fluxocaixa fluxocaixa deleted?
            $fluxocaixa = FluxoCaixa::find($id);
            if(empty($fluxocaixa))
            {
                // Redirect to the fluxocaixa fluxocaixas management page
                return Redirect::to('admin/fluxocaixas')->with('success', Lang::get('admin/fluxocaixas/messages.delete.success'));
            }
        }
        // There was a problem deleting the fluxocaixa fluxocaixa
        return Redirect::to('admin/fluxocaixas')->with('error', Lang::get('admin/fluxocaixas/messages.delete.error'));
    }

    /**
     * Show a list of all the fluxocaixa fluxocaixas formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData()
    {
       
        $fluxocaixas = FluxoCaixa::select(
                        array(
                            'fluxoCaixas.sequencia',
                            'fluxoCaixas.descricao', 
                            'fluxoCaixas.valor AS mes1',
                            'FC2.valor AS mes2',
                            'FC3.valor AS mes3',
                            DB::raw('( IFNULL(fluxoCaixas.valor,0) + IFNULL(FC2.valor,0) + IFNULL(FC3.valor,0))  AS vl_trimestre')                          
                        )
                    )
                    ->leftJoin('fluxoCaixas AS FC2',function($join){
                        $join->on('fluxoCaixas.conta', '=', 'FC2.conta')
                                ->where('FC2.mes_num', '=', 2)
                                ->where('FC2.trimestre', '=',Session::get('trimestre'));
                    })
                    ->leftJoin('fluxoCaixas AS FC3',function($join){
                        $join->on('fluxoCaixas.conta', '=', 'FC3.conta')
                                ->where('FC3.mes_num', '=', 3)
                                ->where('FC3.trimestre', '=',Session::get('trimestre'));
                    })                  
                    ->where('fluxoCaixas.trimestre','=',Session::get('trimestre') )
                    ->where('fluxoCaixas.mes_num','=',1)
                    ->orderBy('fluxoCaixas.sequencia','asc');
        /*$sql = "SELECT         
                    FC.sequencia,
                    FC.descricao, 
                    FC.valor mes1,
                    FC2.valor mes2,
                    FC3.valor mes3,
                    (FC.valor+FC2.valor+FC3.valor) vl_trimestre
                FROM fluxocaixas FC
                    LEFT JOIN fluxocaixas FC2 ON FC2.trimestre = FC.trimestre AND FC.conta = FC2.conta AND FC2.mes_num = 2
                    LEFT JOIN fluxocaixas FC3 ON FC3.trimestre = FC.trimestre AND FC.conta = FC3.conta AND FC3.mes_num = 3
                WHERE FC.trimestre = ?
                 AND FC.mes_num = 1
                ORDER BY FC.sequencia";
        $fluxocaixas = DB::select($sql, array( Session::get('trimestre') ) );*/


        return Datatables::of($fluxocaixas)

        // ->edit_column('tipoPessoa', '@if($tipoPessoa == \'J\') Jurídica @else Física @endif')
        ->edit_column('mes1', '<a href="{{{ URL::to(\'admin/fluxocaixas/1/editar\' ) }}}" class="btn btn-link btn-xs iframe pull-right" title="Clique para editar">{{ DataFormat::moneyBR( $mes1 ) }}</a>')
        ->edit_column('mes2', '<a href="{{{ URL::to(\'admin/fluxocaixas/2/editar\' ) }}}" class="btn btn-link btn-xs iframe pull-right" title="Clique para editar">{{ DataFormat::moneyBR( $mes2 ) }}</a>')
        ->edit_column('mes3', '<a href="{{{ URL::to(\'admin/fluxocaixas/3/editar\' ) }}}" class="btn btn-link btn-xs iframe pull-right" title="Clique para editar">{{ DataFormat::moneyBR( $mes3 ) }}</a>')
        ->edit_column('vl_trimestre', '<span class="pull-right label label-default">{{ DataFormat::moneyBR( $vl_trimestre ) }}</span>')
        // ->add_column('vl_trimestre', '{{ DataFormat::moneyBR( $mes1+$mes2+$mes3 ) }}')

        // ->add_column('actions', '<a href="{{{ URL::to(\'admin/fluxocaixas/\' . $id . \'/editar\' ) }}}" class="btn btn-default btn-xs iframe" >{{{ Lang::get(\'button.edit\') }}}</a> <a href="{{{ URL::to(\'admin/fluxocaixas/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger iframe">{{{ Lang::get(\'button.delete\') }}}</a>')
                
        ->remove_column('sequencia')

        ->make();
    }

}