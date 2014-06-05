<?php

class AdminRepresentantesController extends BaseController {

	
    /**
     * Representante Model
     * @var Representante
     */
    protected $representante;

    /**
     * Inject the models.
     * @param Representante $representante
     */
    public function __construct(Representante $representante)
    {
        parent::__construct();
        $this->representante = $representante;
    }

    /**
     * Show a list of all the representante representantes.
     *
     * @return View
     */
    public function getIndex()
    {
        // Title
        $title = Lang::get('admin/representantes/title.representante_management');

        // Grab all the representante representantes
        $representantes = $this->representante->get();

        // Show the page
        return View::make('admin/representantes/index', compact('representantes', 'title'));
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
        // Title
        $title = Lang::get('admin/representantes/title.create_a_new_representante');
        $estados = Estado::lists('descricao','uf');
        $cargos = Cargo::orderBy('descricao','ASC')->lists('descricao','id');

        // Show the page
        return View::make('admin/representantes/create_edit', compact('title','estados','cargos'));
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
            'CPF'               => 'required',
            'RG'                => 'required',
            'nome'              => 'required',
            'email'             => 'required|email',
            'tipoRepresentante' => 'required',
            'dataExpedicao'     => 'required',
            'orgaoExpeditor'    => 'required',
            'pais'              => 'required',
            'cargo'             => 'required',

            'logradouro'        => 'required',
            'numLogradouro'     => 'required',
            'bairro'            => 'required',
            'municipioIBGE'     => 'required',
            'siglaUF'           => 'required',
            'cep'               => 'required',
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            // Create a new representante representante
            $user = Auth::user();

            // Update the representante representante data
            $this->representante->CPF               = Input::get('CPF');
            $this->representante->RG                = Input::get('RG');
            $this->representante->nome              = Input::get('nome');
            $this->representante->email             = Input::get('email');
            $this->representante->tipoRepresentante = Input::get('tipoRepresentante');
            $this->representante->dataExpedicao     = Input::get('dataExpedicao');
            $this->representante->orgaoExpeditor    = Input::get('orgaoExpeditor');
            $this->representante->pais              = Input::get('pais');
            $this->representante->cargo             = Input::get('cargo');

            // Endereços

            $endereco = Endereco::create(array( 
                    'logradouro'    =>Input::get('logradouro'),
                    'numLogradouro' =>Input::get('numLogradouro'),
                    'complemento'   =>Input::get('complemento'),
                    'bairro'        =>Input::get('bairro'),
                    'municipioIBGE' =>Input::get('municipioIBGE'),
                    'siglaUF'       =>Input::get('siglaUF'),
                    'cep'           =>Input::get('cep'),
                )
            );

            $this->representante->endereco = $endereco->id;
            
            $salvo = $this->representante->save();           

            // Telefones
            if( Input::get('telefones')){
                foreach (Input::get('telefones') as $telefone) {
                   $telefone = Telefone::create( array(
                        'tabela'    => 'representantes',
                        'tabela_id' => $this->representante->id,
                        'codigoDDI' => $telefone['codigoDDI'],
                        'codigoDDD' => $telefone['codigoDDD'],
                        'numeroTel' => $telefone['numeroTel'],
                        'ramal'     => $telefone['ramal'],
                    ));
                }
            }

            // Was the representante representante created?
            if($salvo)
            {
                // Redirect to the new representante representante page
                return Redirect::to('admin/representantes/' . $this->representante->id . '/editar')->with('success', Lang::get('admin/representantes/messages.create.success'));
            }

            // Redirect to the representante representante create page
            return Redirect::to('admin/representantes/create')->with('error', Lang::get('admin/representantes/messages.create.error'));
        }

        // Form validation failed
        return Redirect::to('admin/representantes/create')->withInput()->withErrors($validator);
	}

    /**
     * Display the specified resource.
     *
     * @param $representante
     * @return Response
     */
	public function getShow($representante)
	{
        // redirect to the frontend
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param $representante
     * @return Response
     */
	public function getEdit($representante)
	{
        // Title
        $title = Lang::get('admin/representantes/title.representante_update');  
        $estados = Estado::lists('descricao','uf');
        $cargos = Cargo::orderBy('descricao','ASC')->lists('descricao','id');

        // Show the page
        return View::make('admin/representantes/create_edit', compact('representante', 'title', 'estados','cargos'));
	}

    /**
     * Update the specified resource in storage.
     *
     * @param $representante
     * @return Response
     */
	public function postEdit($representante)
	{

        // Declare the rules for the form validation
        $rules = array(
            'CPF'               => 'required',
            'RG'                => 'required',
            'nome'              => 'required',
            'email'             => 'required|email',
            'tipoRepresentante' => 'required',
            'dataExpedicao'     => 'required',
            'orgaoExpeditor'    => 'required',
            'pais'              => 'required',
            'cargo'             => 'required',

            'logradouro'        => 'required',
            'numLogradouro'     => 'required',
            'bairro'            => 'required',
            'municipioIBGE'     => 'required',
            'siglaUF'           => 'required',
            'cep'               => 'required',
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            // Update the representante representante data
            // Update the representante representante data
            $representante->CPF       = Input::get('CPF');
            $representante->RG        = Input::get('RG');
            $representante->nome      = Input::get('nome');
            $representante->email             = Input::get('email');
            $representante->tipoRepresentante = Input::get('tipoRepresentante');
            $representante->dataExpedicao     = Input::get('dataExpedicao');
            $representante->orgaoExpeditor    = Input::get('orgaoExpeditor');
            $representante->pais              = Input::get('pais');
            $representante->cargo             = Input::get('cargo');

            // Endereços

            $endereco = Endereco::where('id','=',$representante->endereco)->update(array( 
                    'logradouro'    =>Input::get('logradouro'),
                    'numLogradouro' =>Input::get('numLogradouro'),
                    'complemento'   =>Input::get('complemento'),
                    'bairro'        =>Input::get('bairro'),
                    'municipioIBGE' =>Input::get('municipioIBGE'),
                    'siglaUF'       =>Input::get('siglaUF'),
                    'cep'           =>Input::get('cep'),
                )
            );
           

            $salvo = $representante->save();
            
            $removerTelefones = Telefone::where('tabela','=','representantes')->where( 'tabela_id', '=', $representante->id )->delete();

            // Telefones
            if( Input::get('telefones')){
                foreach (Input::get('telefones') as $telefone) {
                   $telefone = Telefone::create( array(
                        'tabela'    => 'representantes',
                        'tabela_id' => $representante->id,
                        'codigoDDI' => $telefone['codigoDDI'],
                        'codigoDDD' => $telefone['codigoDDD'],
                        'numeroTel' => $telefone['numeroTel'],
                        'ramal'     => $telefone['ramal'],
                    ));
                }
            }

            // Was the representante representante updated?
            if($salvo)
            {
                // Redirect to the new representante representante page
                return Redirect::to('admin/representantes/' . $representante->id . '/editar')->with('success', Lang::get('admin/representantes/messages.update.success'));
            }

            // Redirect to the representantes representante management page
            return Redirect::to('admin/representantes/' . $representante->id . '/editar')->with('error', Lang::get('admin/representantes/messages.update.error'));
        }

        // Form validation failed
        return Redirect::to('admin/representantes/' . $representante->id . '/editar')->withInput()->withErrors($validator);
	}


    /**
     * Remove the specified resource from storage.
     *
     * @param $representante
     * @return Response
     */
    public function getDelete($representante)
    {
        // Title
        $title = Lang::get('admin/representantes/title.representante_delete');

        // Show the page
        return View::make('admin/representantes/delete', compact('representante', 'title'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $representante
     * @return Response
     */
    public function postDelete($representante)
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
            $id = $representante->id;
            $representante->delete();

            // Was the representante representante deleted?
            $representante = Representante::find($id);
            if(empty($representante))
            {
                // Redirect to the representante representantes management page
                return Redirect::to('admin/representantes')->with('success', Lang::get('admin/representantes/messages.delete.success'));
            }
        }
        // There was a problem deleting the representante representante
        return Redirect::to('admin/representantes')->with('error', Lang::get('admin/representantes/messages.delete.error'));
    }

    /**
     * Show a list of all the representante representantes formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData()
    {
        $representantes = Representante::select( array( 'representantes.id', 'representantes.CPF', 'representantes.nome', 'representantes.tipoRepresentante' ) );

        return Datatables::of($representantes)

        // ->edit_column('comments', '{{ DB::table(\'comments\')->where(\'representante_id\', \'=\', $id)->count() }}')

        ->add_column('actions', '<a href="{{{ URL::to(\'admin/representantes/\' . $id . \'/editar\' ) }}}" class="btn btn-default btn-xs iframe" >{{{ Lang::get(\'button.edit\') }}}</a> <a href="{{{ URL::to(\'admin/representantes/\' . $id . \'/remover\' ) }}}" class="btn btn-xs btn-danger iframe">{{{ Lang::get(\'button.delete\') }}}</a>')
                // 
        ->remove_column('id')

        ->make();
    }

}