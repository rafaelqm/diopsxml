<?php

class AdminBalancetesController extends BaseController {

	
    /**
     * Lancamento Model
     * @var Lancamento
     */
    protected $balancete;

    /**
     * Inject the models.
     * @param Lancamento $balancete
     */
    public function __construct(Lancamento $balancete)
    {
        parent::__construct();
        $this->balancete = $balancete;
    }

    /**
     * Show a list of all the balancete balancetes.
     *
     * @return View
     */
    public function getIndex()
    {
        if(! Session::has('tipo')){
            Session::put('tipo', 'A');
        }
        // Title
        $title = Lang::get('admin/balancetes/title.balancete_management');

        // Grab all the balancete balancetes
        $balancetes = $this->balancete->get();

        // Show the page
        return View::make('admin/balancetes/index', compact('balancetes', 'title'));
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Lancamentoonse
	 */
	public function getCreate()
	{
        // Title
        $title = Lang::get('admin/balancetes/title.create_a_new_balancete');
        $tipos = array( 'A' => 'Ativo', 
                        'P' => 'Passivo', 
                        'R' => 'Receita', 
                        'D' => 'Despesa'
                );

        // Show the page
        return View::make('admin/balancetes/create_edit', compact('title','tipos'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Lancamentoonse
	 */
	public function postCreate()
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
            // Create a new balancete balancete
            $user = Auth::user();

            // Update the balancete balancete data
            $this->balancete->tipo            = Input::get('tipo');
            $this->balancete->conta           = Input::get('conta');
            $this->balancete->contaTasy       = Input::get('contaTasy');
            $this->balancete->descricao       = Input::get('descricao');
            $this->balancete->saldoAnterior   = DataFormat::moneyBD( Input::get('saldoAnterior',0) );
            $this->balancete->debito          = DataFormat::moneyBD( Input::get('debito',0) );
            $this->balancete->credito         = DataFormat::moneyBD( Input::get('credito',0) );
            $this->balancete->saldoFinal      = DataFormat::moneyBD( Input::get('saldoFinal',0) );
            $this->balancete->inicioPeriodo   = date('Y-m-d');
            $this->balancete->trimestre       = Input::get('trimestre');
           

            $salvo = $this->balancete->save();

            // Was the balancete balancete created?
            if($salvo)
            {
                // Redirect to the new balancete balancete page
                return Redirect::to('admin/balancetes/' . $this->balancete->id . '/editar')->with('success', Lang::get('admin/balancetes/messages.create.success'));
            }

            // Redirect to the balancete balancete create page
            return Redirect::to('admin/balancetes/create')->with('error', Lang::get('admin/balancetes/messages.create.error'));
        }

        // Form validation failed
        return Redirect::to('admin/balancetes/create')->withInput()->withErrors($validator);
	}

    /**
     * Display the specified resource.
     *
     * @param $balancete
     * @return Lancamentoonse
     */
	public function getShow($balancete)
	{
        // redirect to the frontend
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param $balancete
     * @return Lancamentoonse
     */
	public function getEdit($balancete)
	{
        // Title
        $title = Lang::get('admin/balancetes/title.balancete_update');  

        // Show the page
        return View::make('admin/balancetes/create_edit', compact('balancete', 'title'));
	}

    /**
     * Update the specified resource in storage.
     *
     * @param $balancete
     * @return Lancamentoonse
     */
	public function postEdit($balancete)
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
            // Update the balancete balancete data
            $balancete->tipo            = Input::get('tipo');
            $balancete->conta           = Input::get('conta');
            $balancete->contaTasy       = Input::get('contaTasy');
            $balancete->descricao       = Input::get('descricao');
            $balancete->saldoAnterior   = DataFormat::moneyBD( Input::get('saldoAnterior',0) );
            $balancete->debito          = DataFormat::moneyBD( Input::get('debito',0) );
            $balancete->credito         = DataFormat::moneyBD( Input::get('credito',0) );
            $balancete->saldoFinal      = DataFormat::moneyBD( Input::get('saldoFinal',0) );
            $balancete->inicioPeriodo   = date('Y-m-d');
            $balancete->trimestre       = Input::get('trimestre');

            $salvo = $balancete->save();

            // Was the balancete balancete updated?
            if($salvo)
            {
                // Redirect to the new balancete balancete page
                return Redirect::to('admin/balancetes/' . $balancete->id . '/editar')->with('success', Lang::get('admin/balancetes/messages.update.success'));
            }

            // Redirect to the balancetes balancete management page
            return Redirect::to('admin/balancetes/' . $balancete->id . '/editar')->with('error', Lang::get('admin/balancetes/messages.update.error'));
        }

        // Form validation failed
        return Redirect::to('admin/balancetes/' . $balancete->id . '/editar')->withInput()->withErrors($validator);
	}


    /**
     * Remove the specified resource from storage.
     *
     * @param $balancete
     * @return Lancamentoonse
     */
    public function getDelete($balancete)
    {
        // Title
        $title = Lang::get('admin/balancetes/title.balancete_delete');

        // Show the page
        return View::make('admin/balancetes/delete', compact('balancete', 'title'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $balancete
     * @return Lancamentoonse
     */
    public function postDelete($balancete)
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
            $id = $balancete->id;
            $balancete->delete();

            // Was the balancete balancete deleted?
            $balancete = Lancamento::find($id);
            if(empty($balancete))
            {
                // Redirect to the balancete balancetes management page
                return Redirect::to('admin/balancetes')->with('success', Lang::get('admin/balancetes/messages.delete.success'));
            }
        }
        // There was a problem deleting the balancete balancete
        return Redirect::to('admin/balancetes')->with('error', Lang::get('admin/balancetes/messages.delete.error'));
    }

    /**
     * Show a list of all the balancete balancetes formatted for Datatables.
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
        $balancetes = Lancamento::select(
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

        return Datatables::of($balancetes)

        // ->edit_column('tipoPessoa', '@if($tipoPessoa == \'J\') Jurídica @else Física @endif')
        ->edit_column('saldoAnterior', '{{ DataFormat::moneyBR( $saldoAnterior ) }}')
        ->edit_column('debito', '{{ DataFormat::moneyBR( $debito ) }}')
        ->edit_column('credito', '{{ DataFormat::moneyBR( $credito ) }}')
        ->edit_column('saldoFinal', '{{ DataFormat::moneyBR( $saldoFinal ) }}')

        ->add_column('actions', '<a href="{{{ URL::to(\'admin/balancetes/\' . $id . \'/editar\' ) }}}" class="btn btn-default btn-xs iframe" >{{{ Lang::get(\'button.edit\') }}}</a> <a href="{{{ URL::to(\'admin/balancetes/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger iframe">{{{ Lang::get(\'button.delete\') }}}</a>')
                
        ->remove_column('id')

        ->make();
    }

}