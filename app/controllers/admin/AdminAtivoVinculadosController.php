<?php

class AdminAtivoVinculadosController extends BaseController {

	
    /**
     * AtivoVinculado Model
     * @var AtivoVinculado
     */
    protected $ativovinculado;

    /**
     * Inject the models.
     * @param AtivoVinculado $ativovinculado
     */
    public function __construct(AtivoVinculado $ativovinculado)
    {
        parent::__construct();
        $this->ativovinculado = $ativovinculado;
    }

    /**
     * Show a list of all the ativovinculado 
     *
     * @return View
     */
    public function getIndex()
    {
        // Title
        $title = Lang::get('admin/ativovinculados/title.ativovinculado_management');

        // Grab all the ativovinculado ativovinculados
        $ativovinculados = $this->ativovinculado->get();

        // Show the page
        return View::make('admin/ativovinculados/index', compact('ativovinculados', 'title'));
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
        // Title
        $title = Lang::get('admin/ativovinculados/title.create_a_new_ativovinculado');
        $estados = Estado::lists('descricao','uf');
        $cargos = Cargo::orderBy('descricao','ASC')->lists('descricao','id');

        // Show the page
        return View::make('admin/ativovinculados/create_edit', compact('title','estados','cargos'));
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
            
            'rgi'                   => 'required',
            'tipo_bem_imobiliario'  => 'required',
            'nome_cartorio'         => 'required',
            'area_imovel'           => 'required',
            'data_aquisicao'        => 'required',
            'rede_propria'          => 'required',
            'preco_unitario'        => 'required',
            'valor_contabil'        => 'required',

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
            // Create a new ativovinculado ativovinculado
            $user = Auth::user();

            // Update the ativovinculado ativovinculado data
            $this->ativovinculado->trimestre            = Session::get('trimestre');
            $this->ativovinculado->rgi                  = Input::get('rgi');
            $this->ativovinculado->tipo_bem_imobiliario = Input::get('tipo_bem_imobiliario');
            $this->ativovinculado->nome_cartorio        = Input::get('nome_cartorio');
            $this->ativovinculado->area_imovel          = DataFormat::moneyBD( Input::get('area_imovel') );
            $this->ativovinculado->data_aquisicao       = DataFormat::makeUS( Input::get('data_aquisicao') );
            $this->ativovinculado->data_venda           = DataFormat::makeUS( Input::get('data_venda') );
            $this->ativovinculado->data_avaliacao       = DataFormat::makeUS( Input::get('data_avaliacao') );
            $this->ativovinculado->rede_propria         = Input::get('rede_propria');
            $this->ativovinculado->preco_unitario       = DataFormat::moneyBD( Input::get('preco_unitario') );
            $this->ativovinculado->valor_contabil       = DataFormat::moneyBD( Input::get('valor_contabil') );

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

            $this->ativovinculado->endereco = $endereco->id;
            
            $salvo = $this->ativovinculado->save();           

            // Telefones
            if( Input::get('telefones')){
                foreach (Input::get('telefones') as $telefone) {
                   $telefone = Telefone::create( array(
                        'tabela'    => 'ativovinculados',
                        'tabela_id' => $this->ativovinculado->id,
                        'codigoDDI' => $telefone['codigoDDI'],
                        'codigoDDD' => $telefone['codigoDDD'],
                        'numeroTel' => $telefone['numeroTel'],
                        'ramal'     => $telefone['ramal'],
                    ));
                }
            }

            // Was the ativovinculado ativovinculado created?
            if($salvo)
            {
                // Redirect to the new ativovinculado ativovinculado page
                return Redirect::to('admin/ativovinculados/' . $this->ativovinculado->id . '/editar')->with('success', Lang::get('admin/ativovinculados/messages.create.success'));
            }

            // Redirect to the ativovinculado ativovinculado create page
            return Redirect::to('admin/ativovinculados/create')->with('error', Lang::get('admin/ativovinculados/messages.create.error'));
        }

        // Form validation failed
        return Redirect::to('admin/ativovinculados/create')->withInput()->withErrors($validator);
	}

    /**
     * Display the specified resource.
     *
     * @param $ativovinculado
     * @return Response
     */
	public function getShow($ativovinculado)
	{
        // redirect to the frontend
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param $ativovinculado
     * @return Response
     */
	public function getEdit($ativovinculado)
	{
        // Title
        $title = Lang::get('admin/ativovinculados/title.ativovinculado_update');  
        $estados = Estado::lists('descricao','uf');
        $cargos = Cargo::orderBy('descricao','ASC')->lists('descricao','id');

        // Show the page
        return View::make('admin/ativovinculados/create_edit', compact('ativovinculado', 'title', 'estados','cargos'));
	}

    /**
     * Update the specified resource in storage.
     *
     * @param $ativovinculado
     * @return Response
     */
	public function postEdit($ativovinculado)
	{

        // Declare the rules for the form validation
         $rules = array(
            'rgi'                   => 'required',
            'tipo_bem_imobiliario'  => 'required',
            'nome_cartorio'         => 'required',
            'area_imovel'           => 'required',
            'data_aquisicao'        => 'required',
            'rede_propria'          => 'required',
            'preco_unitario'        => 'required',
            'valor_contabil'        => 'required',

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
            // Update the ativovinculado ativovinculado data
            // Update the ativovinculado ativovinculado data
            // $ativovinculado->trimestre            = Input::get('trimestre');
            $ativovinculado->rgi                  = Input::get('rgi');
            $ativovinculado->tipo_bem_imobiliario = Input::get('tipo_bem_imobiliario');
            $ativovinculado->nome_cartorio        = Input::get('nome_cartorio');
            $ativovinculado->area_imovel          = DataFormat::moneyBD( Input::get('area_imovel') );
            $ativovinculado->data_aquisicao       = DataFormat::makeUS( Input::get('data_aquisicao') );
            $ativovinculado->data_venda           = DataFormat::makeUS( Input::get('data_venda') );
            $ativovinculado->data_avaliacao       = DataFormat::makeUS( Input::get('data_avaliacao') );
            $ativovinculado->rede_propria         = Input::get('rede_propria');
            $ativovinculado->preco_unitario       = DataFormat::moneyBD( Input::get('preco_unitario') );
            $ativovinculado->valor_contabil       = DataFormat::moneyBD( Input::get('valor_contabil') );

            // Endereços

            $endereco = Endereco::where('id','=',$ativovinculado->endereco)->update(array( 
                    'logradouro'    =>Input::get('logradouro'),
                    'numLogradouro' =>Input::get('numLogradouro'),
                    'complemento'   =>Input::get('complemento'),
                    'bairro'        =>Input::get('bairro'),
                    'municipioIBGE' =>Input::get('municipioIBGE'),
                    'siglaUF'       =>Input::get('siglaUF'),
                    'cep'           =>Input::get('cep'),
                )
            );
           

            $salvo = $ativovinculado->save();
            
            $removerTelefones = Telefone::where('tabela','=','ativovinculados')->where( 'tabela_id', '=', $ativovinculado->id )->delete();

            // Telefones
            if( Input::get('telefones')){
                foreach (Input::get('telefones') as $telefone) {
                   $telefone = Telefone::create( array(
                        'tabela'    => 'ativovinculados',
                        'tabela_id' => $ativovinculado->id,
                        'codigoDDI' => $telefone['codigoDDI'],
                        'codigoDDD' => $telefone['codigoDDD'],
                        'numeroTel' => $telefone['numeroTel'],
                        'ramal'     => $telefone['ramal'],
                    ));
                }
            }

            // Was the ativovinculado ativovinculado updated?
            if($salvo)
            {
                // Redirect to the new ativovinculado ativovinculado page
                return Redirect::to('admin/ativovinculados/' . $ativovinculado->id . '/editar')->with('success', Lang::get('admin/ativovinculados/messages.update.success'));
            }

            // Redirect to the ativovinculados ativovinculado management page
            return Redirect::to('admin/ativovinculados/' . $ativovinculado->id . '/editar')->with('error', Lang::get('admin/ativovinculados/messages.update.error'));
        }

        // Form validation failed
        return Redirect::to('admin/ativovinculados/' . $ativovinculado->id . '/editar')->withInput()->withErrors($validator);
	}


    /**
     * Remove the specified resource from storage.
     *
     * @param $ativovinculado
     * @return Response
     */
    public function getDelete($ativovinculado)
    {
        // Title
        $title = Lang::get('admin/ativovinculados/title.ativovinculado_delete');

        // Show the page
        return View::make('admin/ativovinculados/delete', compact('ativovinculado', 'title'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $ativovinculado
     * @return Response
     */
    public function postDelete($ativovinculado)
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
            $id = $ativovinculado->id;
            $ativovinculado->delete();

            // Was the ativovinculado ativovinculado deleted?
            $ativovinculado = AtivoVinculado::find($id);
            if(empty($ativovinculado))
            {
                // Redirect to the ativovinculado ativovinculados management page
                return Redirect::to('admin/ativovinculados')->with('success', Lang::get('admin/ativovinculados/messages.delete.success'));
            }
        }
        // There was a problem deleting the ativovinculado ativovinculado
        return Redirect::to('admin/ativovinculados')->with('error', Lang::get('admin/ativovinculados/messages.delete.error'));
    }

    /**
     * Show a list of all the ativovinculado ativovinculados formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData()
    {
        $ativovinculados = AtivoVinculado::select( array(   'id',
                                                            'rgi',
                                                            'tipo_bem_imobiliario',
                                                            'nome_cartorio',
                                                            'area_imovel',
                                                            'data_aquisicao',
                                                            'data_venda',
                                                            'data_avaliacao',
                                                            'rede_propria',
                                                            'preco_unitario',
                                                            'valor_contabil' 
                                                        ) 
                            );

        return Datatables::of($ativovinculados)

        ->edit_column('area_imovel', '{{ DataFormat::moneyBR( $area_imovel ) }}')
        ->edit_column('preco_unitario', '{{ DataFormat::moneyBR( $preco_unitario ) }}')
        ->edit_column('valor_contabil', '{{ DataFormat::moneyBR( $valor_contabil ) }}')

        ->edit_column('data_aquisicao', '{{ DataFormat::makeBR($data_aquisicao) }}')
        ->edit_column('data_venda', '{{ DataFormat::makeBR($data_venda) }}')
        ->edit_column('data_avaliacao', '{{ DataFormat::makeBR($data_avaliacao) }}')

        ->add_column('actions', '<a href="{{{ URL::to(\'admin/ativovinculados/\' . $id . \'/editar\' ) }}}" class="btn btn-default btn-xs iframe" >{{{ Lang::get(\'button.edit\') }}}</a> <a href="{{{ URL::to(\'admin/ativovinculados/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger iframe">{{{ Lang::get(\'button.delete\') }}}</a>')
                // 
        ->remove_column('id')

        ->make();
    }

}