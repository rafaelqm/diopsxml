<?php

class AdminOperadorasController extends BaseController {

	
    /**
     * Operadora Model
     * @var Operadora
     */
    protected $operadora;

    /**
     * Inject the models.
     * @param Operadora $operadora
     */
    public function __construct(Operadora $operadora)
    {
        parent::__construct();
        $this->operadora = $operadora;
    }

    /**
     * Show a list of all the operadora operadoras.
     *
     * @return View
     */
    public function getIndex()
    {
        // Title
        $title = Lang::get('admin/operadoras/title.operadora_management');

        // Grab all the operadora operadoras
        $operadoras = $this->operadora->get();

        // Show the page
        return View::make('admin/operadoras/index', compact('operadoras', 'title'));
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
        // Title
        $title          = Lang::get('admin/operadoras/title.create_a_new_operadora');
        $estados        = Estado::lists(    'descricao','uf');
        $modalidades    = Modalidade::lists('descricao','codigo');
        $segmentos      = Segmento::lists(  'descricao','codigo');

        // Show the page
        return View::make('admin/operadoras/create_edit', compact('title','estados','modalidades','segmentos') );
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
            'registroANS'   => 'required',
            'razaoSocial'   => 'required',
            'nomeFantasia'  => 'required',
            'CNPJ'          => 'required',
            'eMail'         => 'required|email',
            'logradouroMatriz'    => 'required',
            'numLogradouroMatriz' => 'required',
            'bairroMatriz'        => 'required',
            'municipioIBGEMatriz' => 'required',
            'siglaUFMatriz'       => 'required',
            'cepMatriz'           => 'required',

            'segmentacao'           => 'required',
            'modalidade'            => 'required',
            'siglaUF'               => 'required',
            'municipioIBGE'         => 'required',
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            // Create a new operadora operadora
            $user = Auth::user();

            // Update the operadora operadora data
            $this->operadora->registroANS       = Input::get('registroANS');
            $this->operadora->razaoSocial       = Input::get('razaoSocial');
            $this->operadora->nomeFantasia      = Input::get('nomeFantasia');
            $this->operadora->CNPJ              = Input::get('CNPJ');
            $this->operadora->eMail             = Input::get('eMail');
            $this->operadora->naturezaJuridica  = Input::get('naturezaJuridica');
            
            $this->operadora->segmentacao     = Input::get('segmentacao');
            $this->operadora->modalidade      = Input::get('modalidade');
            $this->operadora->siglaUF         = Input::get('siglaUF');
            $this->operadora->municipioIBGE   = Input::get('municipioIBGE');

            $this->operadora->totalmentePulverizado         = Input::get('totalmentePulverizado');
            $this->operadora->totalAcoesQuotas              = str_replace(',', '.', Input::get('totalAcoesQuotas') ) ;
            // Endereços

            $endereco = Endereco::create(array( 
                    'logradouro'    =>Input::get('logradouroMatriz'),
                    'numLogradouro' =>Input::get('numLogradouroMatriz'),
                    'complemento'   =>Input::get('complementoMatriz'),
                    'bairro'        =>Input::get('bairroMatriz'),
                    'municipioIBGE' =>Input::get('municipioIBGEMatriz'),
                    'siglaUF'       =>Input::get('siglaUFMatriz'),
                    'cep'           =>Input::get('cepMatriz'),
                )
            );

            $this->operadora->endereco_matriz = $endereco->id;

            if( Input::get('enderecoIgualMatriz') || !Input::has('logradouroCorrespondencia')  ){
                $this->operadora->endereco_corresp = $endereco->id;
            }else{
                 $endereco = Endereco::create(array( 
                        'logradouro'    =>Input::get('logradouroCorrespondencia'),
                        'numLogradouro' =>Input::get('numLogradouroCorrespondencia'),
                        'complemento'   =>Input::get('complementoCorrespondencia'),
                        'bairro'        =>Input::get('bairroCorrespondencia'),
                        'municipioIBGE' =>Input::get('municipioIBGECorrespondencia'),
                        'siglaUF'       =>Input::get('siglaUFCorrespondencia'),
                        'cep'           =>Input::get('cepCorrespondencia'),
                    )
                );
                $this->operadora->endereco_corresp = $endereco->id;
            }

            $salvo = $this->operadora->save();

            


           

            // Telefones
            if( Input::get('telefones')){
                foreach (Input::get('telefones') as $telefone) {
                   $telefone = Telefone::create( array(
                        'tabela'    => 'operadoras',
                        'tabela_id' => $this->operadora->id,
                        'codigoDDI' => $telefone['codigoDDI'],
                        'codigoDDD' => $telefone['codigoDDD'],
                        'numeroTel' => $telefone['numeroTel'],
                        'ramal'     => $telefone['ramal'],
                    ));
                }
            }

            // Was the operadora operadora created?
            if($salvo)
            {
                // Redirect to the new operadora operadora page
                return Redirect::to('admin/operadoras/' . $this->operadora->id . '/editar')->with('success', Lang::get('admin/operadoras/messages.create.success'));
            }

            // Redirect to the operadora operadora create page
            return Redirect::to('admin/operadoras/create')->with('error', Lang::get('admin/operadoras/messages.create.error'));
        }

        // Form validation failed
        return Redirect::to('admin/operadoras/create')->withInput()->withErrors($validator);
	}

    /**
     * Display the specified resource.
     *
     * @param $operadora
     * @return Response
     */
	public function getShow($operadora)
	{
        // redirect to the frontend
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param $operadora
     * @return Response
     */
	public function getEdit($operadora)
	{
        // Title
        $title = Lang::get('admin/operadoras/title.operadora_update');  
        $estados = Estado::lists('descricao','uf');
        $modalidades    = Modalidade::lists('descricao','codigo');
        $segmentos      = Segmento::lists(  'descricao','codigo');

        // Show the page
        return View::make('admin/operadoras/create_edit', compact('operadora', 'title', 'estados', 'modalidades', 'segmentos'));
	}

    /**
     * Update the specified resource in storage.
     *
     * @param $operadora
     * @return Response
     */
	public function postEdit($operadora)
	{

        // Declare the rules for the form validation
        $rules = array(
            'registroANS'   => 'required',
            'razaoSocial'   => 'required',
            'nomeFantasia'  => 'required',
            'CNPJ'          => 'required',
            'eMail'         => 'required|email',
            'logradouroMatriz'    => 'required',
            'numLogradouroMatriz' => 'required',
            'bairroMatriz'        => 'required',
            'municipioIBGEMatriz' => 'required',
            'siglaUFMatriz'       => 'required',
            'cepMatriz'           => 'required',

            'segmentacao'           => 'required',
            'modalidade'            => 'required',
            'siglaUF'               => 'required',
            'municipioIBGE'         => 'required',
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            // Update the operadora operadora data
            $operadora->registroANS       = Input::get('registroANS');
            $operadora->razaoSocial       = Input::get('razaoSocial');
            $operadora->nomeFantasia      = Input::get('nomeFantasia');
            $operadora->CNPJ              = Input::get('CNPJ');
            $operadora->eMail             = Input::get('eMail');
            $operadora->naturezaJuridica  = Input::get('naturezaJuridica');

            $operadora->segmentacao     = Input::get('segmentacao');
            $operadora->modalidade      = Input::get('modalidade');
            $operadora->siglaUF         = Input::get('siglaUF');
            $operadora->municipioIBGE   = Input::get('municipioIBGE');

            $operadora->totalmentePulverizado         = Input::get('totalmentePulverizado');
            $operadora->totalAcoesQuotas              = str_replace(',', '.', Input::get('totalAcoesQuotas') ) ;
            // Endereços

            $endereco = Endereco::where('id','=',$operadora->endereco_matriz)->update(array( 
                    'logradouro'    =>Input::get('logradouroMatriz'),
                    'numLogradouro' =>Input::get('numLogradouroMatriz'),
                    'complemento'   =>Input::get('complementoMatriz'),
                    'bairro'        =>Input::get('bairroMatriz'),
                    'municipioIBGE' =>Input::get('municipioIBGEMatriz'),
                    'siglaUF'       =>Input::get('siglaUFMatriz'),
                    'cep'           =>Input::get('cepMatriz'),
                )
            );
           
            if( Input::get('enderecoIgualMatriz') || !Input::has('logradouroCorrespondencia')  ){
                $operadora->endereco_corresp = $operadora->endereco_matriz;
            }else{

                if(Input::get('logradouroMatriz') != Input::get('logradouroCorrespondencia')){

                    if($operadora->endereco_corresp == $operadora->endereco_matriz){

                        $endereco = Endereco::create(array( 
                                'logradouro'    =>Input::get('logradouroCorrespondencia'),
                                'numLogradouro' =>Input::get('numLogradouroCorrespondencia'),
                                'complemento'   =>Input::get('complementoCorrespondencia'),
                                'bairro'        =>Input::get('bairroCorrespondencia'),
                                'municipioIBGE' =>Input::get('municipioIBGECorrespondencia'),
                                'siglaUF'       =>Input::get('siglaUFCorrespondencia'),
                                'cep'           =>Input::get('cepCorrespondencia'),
                            )
                        );
                        $operadora->endereco_corresp = $endereco->id;
                    }else{

                        $endereco = Endereco::where('id','=',$operadora->endereco_corresp)->update(array( 
                                'logradouro'    =>Input::get('logradouroCorrespondencia'),
                                'numLogradouro' =>Input::get('numLogradouroCorrespondencia'),
                                'complemento'   =>Input::get('complementoCorrespondencia'),
                                'bairro'        =>Input::get('bairroCorrespondencia'),
                                'municipioIBGE' =>Input::get('municipioIBGECorrespondencia'),
                                'siglaUF'       =>Input::get('siglaUFCorrespondencia'),
                                'cep'           =>Input::get('cepCorrespondencia'),
                            )
                        );
                    }

                    
                }

            }

            $salvo = $operadora->save();

            
            $removerTelefones = Telefone::where('tabela','=','operadoras')->where( 'tabela_id', '=', $operadora->id )->delete();

           

            // Telefones
            if( Input::get('telefones')){
                foreach (Input::get('telefones') as $telefone) {
                   $telefone = Telefone::create( array(
                        'tabela'    => 'operadoras',
                        'tabela_id' => $operadora->id,
                        'codigoDDI' => $telefone['codigoDDI'],
                        'codigoDDD' => $telefone['codigoDDD'],
                        'numeroTel' => $telefone['numeroTel'],
                        'ramal'     => $telefone['ramal'],
                    ));
                }
            }

            // Was the operadora operadora updated?
            if($salvo)
            {
                // Redirect to the new operadora operadora page
                return Redirect::to('admin/operadoras/' . $operadora->id . '/editar')->with('success', Lang::get('admin/operadoras/messages.update.success'));
            }

            // Redirect to the operadoras operadora management page
            return Redirect::to('admin/operadoras/' . $operadora->id . '/editar')->with('error', Lang::get('admin/operadoras/messages.update.error'));
        }

        // Form validation failed
        return Redirect::to('admin/operadoras/' . $operadora->id . '/editar')->withInput()->withErrors($validator);
	}


    /**
     * Remove the specified resource from storage.
     *
     * @param $operadora
     * @return Response
     */
    public function getDelete($operadora)
    {
        // Title
        $title = Lang::get('admin/operadoras/title.operadora_delete');

        // Show the page
        return View::make('admin/operadoras/delete', compact('operadora', 'title'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $operadora
     * @return Response
     */
    public function postDelete($operadora)
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
            $id = $operadora->id;
            $operadora->delete();

            // Was the operadora operadora deleted?
            $operadora = Operadora::find($id);
            if(empty($operadora))
            {
                // Redirect to the operadora operadoras management page
                return Redirect::to('admin/operadoras')->with('success', Lang::get('admin/operadoras/messages.delete.success'));
            }
        }
        // There was a problem deleting the operadora operadora
        return Redirect::to('admin/operadoras')->with('error', Lang::get('admin/operadoras/messages.delete.error'));
    }

    /**
     * Show a list of all the operadora operadoras formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData()
    {
        $operadoras = Operadora::select(array('operadoras.id', 'operadoras.registroANS', 'operadoras.CNPJ','operadoras.razaoSocial', 'operadoras.nomeFantasia'));

        return Datatables::of($operadoras)

        // ->edit_column('comments', '{{ DB::table(\'comments\')->where(\'operadora_id\', \'=\', $id)->count() }}')

        ->add_column('actions', '<a href="{{{ URL::to(\'admin/operadoras/\' . $id . \'/editar\' ) }}}" class="btn btn-default btn-xs iframe" >{{{ Lang::get(\'button.edit\') }}}</a>')
                // <a href="{{{ URL::to(\'admin/operadoras/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger iframe">{{{ Lang::get(\'button.delete\') }}}</a>
        ->remove_column('id')

        ->make();
    }

}