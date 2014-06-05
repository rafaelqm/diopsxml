<?php

class AdminAdminsController extends BaseController {

	
    /**
     * Admin Model
     * @var Admin
     */
    protected $admin;

    /**
     * Inject the models.
     * @param Admin $admin
     */
    public function __construct(Admin $admin)
    {
        parent::__construct();
        $this->admin = $admin;
    }

    /**
     * Show a list of all the admin admins.
     *
     * @return View
     */
    public function getIndex()
    {
        // Title
        $title = Lang::get('admin/admins/title.admin_management');

        // Grab all the admin admins
        $admins = $this->admin->get();

        // Show the page
        return View::make('admin/admins/index', compact('admins', 'title'));
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
        // Title
        $title = Lang::get('admin/admins/title.create_a_new_admin');
        $cargos = Cargo::orderBy('descricao','ASC')->lists('descricao','id');

        // Show the page
        return View::make('admin/admins/create_edit', compact('title','cargos'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postCreate()
	{

        // Declare the rules for the form validation
        $rules = array(
            'CPF'              => 'required_if:estrangeiro,0',
            'nome'              => 'required',
            'nomeMae'           => 'required',
            'cargoFuncao'       => 'required',
            'dataIniMandato'    => 'required',           
            'tipo'              => 'required_if:resposavelTecnico,1',  
            'crm'              => 'required_if:resposavelTecnico,1',  
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            // Create a new admin admin
            $user = Auth::user();

            $dataFimMandato = ( Input::get('dataFimMandato', '-') != '-'  ? DataFormat::makeUS( Input::get('dataFimMandato') )  : NULL);

            // Update the admin admin data
            $this->admin->CPF               = Input::get('CPF');
            $this->admin->estrangeiro       = Input::get('estrangeiro',0);
            $this->admin->nome              = Input::get('nome');
            $this->admin->nomeMae           = Input::get('nomeMae');
            $this->admin->cargoFuncao       = Input::get('cargoFuncao');
            $this->admin->dataIniMandato    = DataFormat::makeUS(Input::get('dataIniMandato'));
            $this->admin->dataFimMandato    = $dataFimMandato ;
            $this->admin->resposavelTecnico = Input::get('resposavelTecnico');
            $this->admin->tipo              = Input::get('tipo');
            $this->admin->crm               = Input::get('crm');
           

            $salvo = $this->admin->save();

            // Was the admin admin created?
            if($salvo)
            {
                // Redirect to the new admin admin page
                return Redirect::to('admin/admins/' . $this->admin->id . '/editar')->with('success', Lang::get('admin/admins/messages.create.success'));
            }

            // Redirect to the admin admin create page
            return Redirect::to('admin/admins/create')->with('error', Lang::get('admin/admins/messages.create.error'));
        }

        // Form validation failed
        return Redirect::to('admin/admins/create')->withInput()->withErrors($validator);
	}

    /**
     * Display the specified resource.
     *
     * @param $admin
     * @return Response
     */
	public function getShow($admin)
	{
        // redirect to the frontend
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param $admin
     * @return Response
     */
	public function getEdit($admin)
	{
        // Title
        $title = Lang::get('admin/admins/title.admin_update');  
        $cargos = Cargo::lists('descricao','id');

        // Show the page
        return View::make('admin/admins/create_edit', compact('admin', 'cargos', 'title'));
	}

    /**
     * Update the specified resource in storage.
     *
     * @param $admin
     * @return Response
     */
	public function postEdit($admin)
	{

        // Declare the rules for the form validation
        $rules = array(
            'CPF'              => 'required_if:estrangeiro,0',
            'nome'              => 'required',
            'nomeMae'           => 'required',
            'cargoFuncao'       => 'required',
            'dataIniMandato'    => 'required',       
            'tipo'              => 'required_if:resposavelTecnico,1',  
            'crm'              => 'required_if:resposavelTecnico,1',    
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            $dataFimMandato = ( Input::get('dataFimMandato', '-') != '-'  ? DataFormat::makeUS( Input::get('dataFimMandato') )  : NULL);

            // Update the admin admin data
            $admin->CPF               = Input::get('CPF');
            $admin->estrangeiro       = Input::get('estrangeiro',0);
            $admin->nome              = Input::get('nome');
            $admin->nomeMae           = Input::get('nomeMae');
            $admin->cargoFuncao       = Input::get('cargoFuncao');
            $admin->dataIniMandato    = DataFormat::makeUS(Input::get('dataIniMandato'));
            $admin->dataFimMandato    = $dataFimMandato;
            $admin->resposavelTecnico = Input::get('resposavelTecnico');
            $admin->tipo              = Input::get('tipo');
            $admin->crm               = Input::get('crm');

            $salvo = $admin->save();

            // Was the admin admin updated?
            if($salvo)
            {
                // Redirect to the new admin admin page
                return Redirect::to('admin/admins/' . $admin->id . '/editar')->with('success', Lang::get('admin/admins/messages.update.success'));
            }

            // Redirect to the admins admin management page
            return Redirect::to('admin/admins/' . $admin->id . '/editar')->with('error', Lang::get('admin/admins/messages.update.error'));
        }

        // Form validation failed
        return Redirect::to('admin/admins/' . $admin->id . '/editar')->withInput()->withErrors($validator);
	}


    /**
     * Remove the specified resource from storage.
     *
     * @param $admin
     * @return Response
     */
    public function getDelete($admin)
    {
        // Title
        $title = Lang::get('admin/admins/title.admin_delete');

        // Show the page
        return View::make('admin/admins/delete', compact('admin', 'title'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $admin
     * @return Response
     */
    public function postDelete($admin)
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
            $id = $admin->id;
            $admin->delete();

            // Was the admin admin deleted?
            $admin = Admin::find($id);
            if(empty($admin))
            {
                // Redirect to the admin admins management page
                return Redirect::to('admin/admins')->with('success', Lang::get('admin/admins/messages.delete.success'));
            }
        }
        // There was a problem deleting the admin admin
        return Redirect::to('admin/admins')->with('error', Lang::get('admin/admins/messages.delete.error'));
    }

    /**
     * Show a list of all the admin admins formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData()
    {
        $admins = Admin::select(array('admins.id', 'admins.cpf', 'admins.nome','admins.dataIniMandato', 'admins.dataFimMandato', 'admins.resposavelTecnico'));

        return Datatables::of($admins)

        ->edit_column('resposavelTecnico', '@if($resposavelTecnico == \'1\') Sim @else Não @endif')
        ->edit_column('dataIniMandato', '{{ DataFormat::makeBR($dataIniMandato) }}')
        ->edit_column('dataFimMandato', '@if($dataFimMandato != \'0000-00-00\') {{ DataFormat::makeBR($dataFimMandato) }} @endif')

        ->add_column('actions', '<a href="{{{ URL::to(\'admin/admins/\' . $id . \'/editar\' ) }}}" class="btn btn-default btn-xs iframe" >{{{ Lang::get(\'button.edit\') }}}</a> <a href="{{{ URL::to(\'admin/admins/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger iframe">{{{ Lang::get(\'button.delete\') }}}</a>')
                
        // ->remove_column('id')

        ->make();
    }

}