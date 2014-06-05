<?php

class AdminRespsController extends BaseController {

	
    /**
     * Resp Model
     * @var Resp
     */
    protected $resp;

    /**
     * Inject the models.
     * @param Resp $resp
     */
    public function __construct(Resp $resp)
    {
        parent::__construct();
        $this->resp = $resp;
    }

    /**
     * Show a list of all the resp resps.
     *
     * @return View
     */
    public function getIndex()
    {
        // Title
        $title = Lang::get('admin/resps/title.resp_management');

        // Grab all the resp resps
        $resps = $this->resp->get();

        // Show the page
        return View::make('admin/resps/index', compact('resps', 'title'));
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
        // Title
        $title = Lang::get('admin/resps/title.create_a_new_resp');
        $estados = Estado::lists('descricao','uf');

        // Show the page
        return View::make('admin/resps/create_edit', compact('title','estados'));
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
            'tipoPessoa'   => 'required',
            'nome'   => 'required',
            'cpfCnpj'  => 'required',
            'tipo'          => 'required',
            'numRegistro'    => 'required',
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            // Create a new resp resp
            $user = Auth::user();

            // Update the resp resp data
            $this->resp->tipoPessoa     = Input::get('tipoPessoa');
            $this->resp->nome           = Input::get('nome');
            $this->resp->cpfCnpj        = Input::get('cpfCnpj');
            $this->resp->tipo           = Input::get('tipo');
            $this->resp->numRegistro    = Input::get('numRegistro');
           

            $salvo = $this->resp->save();

            // Was the resp resp created?
            if($salvo)
            {
                // Redirect to the new resp resp page
                return Redirect::to('admin/resps/' . $this->resp->id . '/editar')->with('success', Lang::get('admin/resps/messages.create.success'));
            }

            // Redirect to the resp resp create page
            return Redirect::to('admin/resps/create')->with('error', Lang::get('admin/resps/messages.create.error'));
        }

        // Form validation failed
        return Redirect::to('admin/resps/create')->withInput()->withErrors($validator);
	}

    /**
     * Display the specified resource.
     *
     * @param $resp
     * @return Response
     */
	public function getShow($resp)
	{
        // redirect to the frontend
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param $resp
     * @return Response
     */
	public function getEdit($resp)
	{
        // Title
        $title = Lang::get('admin/resps/title.resp_update');  

        // Show the page
        return View::make('admin/resps/create_edit', compact('resp', 'title'));
	}

    /**
     * Update the specified resource in storage.
     *
     * @param $resp
     * @return Response
     */
	public function postEdit($resp)
	{

        // Declare the rules for the form validation
        $rules = array(
            'tipoPessoa'    => 'required',
            'nome'          => 'required',
            'cpfCnpj'       => 'required',
            'tipo'          => 'required',
            'numRegistro'   => 'required',            
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            // Update the resp resp data
            $resp->tipoPessoa   = Input::get('tipoPessoa');
            $resp->nome         = Input::get('nome');
            $resp->cpfCnpj      = Input::get('cpfCnpj');
            $resp->tipo         = Input::get('tipo');
            $resp->numRegistro  = Input::get('numRegistro');

            $salvo = $resp->save();

            // Was the resp resp updated?
            if($salvo)
            {
                // Redirect to the new resp resp page
                return Redirect::to('admin/resps/' . $resp->id . '/editar')->with('success', Lang::get('admin/resps/messages.update.success'));
            }

            // Redirect to the resps resp management page
            return Redirect::to('admin/resps/' . $resp->id . '/editar')->with('error', Lang::get('admin/resps/messages.update.error'));
        }

        // Form validation failed
        return Redirect::to('admin/resps/' . $resp->id . '/editar')->withInput()->withErrors($validator);
	}


    /**
     * Remove the specified resource from storage.
     *
     * @param $resp
     * @return Response
     */
    public function getDelete($resp)
    {
        // Title
        $title = Lang::get('admin/resps/title.resp_delete');

        // Show the page
        return View::make('admin/resps/delete', compact('resp', 'title'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $resp
     * @return Response
     */
    public function postDelete($resp)
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
            $id = $resp->id;
            $resp->delete();

            // Was the resp resp deleted?
            $resp = Resp::find($id);
            if(empty($resp))
            {
                // Redirect to the resp resps management page
                return Redirect::to('admin/resps')->with('success', Lang::get('admin/resps/messages.delete.success'));
            }
        }
        // There was a problem deleting the resp resp
        return Redirect::to('admin/resps')->with('error', Lang::get('admin/resps/messages.delete.error'));
    }

    /**
     * Show a list of all the resp resps formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData()
    {
        $resps = Resp::select(array('resps.id', 'resps.tipoPessoa', 'resps.nome','resps.cpfCnpj', 'resps.tipo', 'resps.numRegistro'));

        return Datatables::of($resps)

        ->edit_column('tipoPessoa', '@if($tipoPessoa == \'J\') Jurídica @else Física @endif')
        ->edit_column('tipo', '@if($tipo == \'U\') Auditoria @elseif($tipo == \'T\') Atuária @else Contabilidade @endif')

        ->add_column('actions', '<a href="{{{ URL::to(\'admin/resps/\' . $id . \'/editar\' ) }}}" class="btn btn-default btn-xs iframe" >{{{ Lang::get(\'button.edit\') }}}</a> <a href="{{{ URL::to(\'admin/resps/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger iframe">{{{ Lang::get(\'button.delete\') }}}</a>')
                
        ->remove_column('id')

        ->make();
    }

}