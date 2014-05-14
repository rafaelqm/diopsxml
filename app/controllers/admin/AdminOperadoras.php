<?php

class AdminOperadoras extends BaseController {

	
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
        $operadoras = $this->operadora;

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
        $title = Lang::get('admin/operadoras/title.create_a_new_operadora');

        // Show the page
        return View::make('admin/operadoras/create_edit', compact('title'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function operadoraCreate()
	{
        // Declare the rules for the form validation
        $rules = array(
            'title'   => 'required|min:3',
            'content' => 'required|min:3'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            // Create a new operadora operadora
            $user = Auth::user();

            // Update the operadora operadora data
            $this->operadora->title            = Input::get('title');
            $this->operadora->slug             = Str::slug(Input::get('title'));
            $this->operadora->content          = Input::get('content');
            $this->operadora->meta_title       = Input::get('meta-title');
            $this->operadora->meta_description = Input::get('meta-description');
            $this->operadora->meta_keywords    = Input::get('meta-keywords');
            $this->operadora->user_id          = $user->id;

            // Was the operadora operadora created?
            if($this->operadora->save())
            {
                // Redirect to the new operadora operadora page
                return Redirect::to('admin/operadoras/' . $this->operadora->id . '/edit')->with('success', Lang::get('admin/operadoras/messages.create.success'));
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

        // Show the page
        return View::make('admin/operadoras/create_edit', compact('operadora', 'title'));
	}

    /**
     * Update the specified resource in storage.
     *
     * @param $operadora
     * @return Response
     */
	public function operadoraEdit($operadora)
	{

        // Declare the rules for the form validation
        $rules = array(
            'title'   => 'required|min:3',
            'content' => 'required|min:3'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            // Update the operadora operadora data
            $operadora->title            = Input::get('title');
            $operadora->slug             = Str::slug(Input::get('title'));
            $operadora->content          = Input::get('content');
            $operadora->meta_title       = Input::get('meta-title');
            $operadora->meta_description = Input::get('meta-description');
            $operadora->meta_keywords    = Input::get('meta-keywords');

            // Was the operadora operadora updated?
            if($operadora->save())
            {
                // Redirect to the new operadora operadora page
                return Redirect::to('admin/operadoras/' . $operadora->id . '/edit')->with('success', Lang::get('admin/operadoras/messages.update.success'));
            }

            // Redirect to the operadoras operadora management page
            return Redirect::to('admin/operadoras/' . $operadora->id . '/edit')->with('error', Lang::get('admin/operadoras/messages.update.error'));
        }

        // Form validation failed
        return Redirect::to('admin/operadoras/' . $operadora->id . '/edit')->withInput()->withErrors($validator);
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
    public function operadoraDelete($operadora)
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
        $operadoras = Operadora::select(array('operadoras.id', 'operadoras.title', 'operadoras.id as comments', 'operadoras.created_at'));

        return Datatables::of($operadoras)

        ->edit_column('comments', '{{ DB::table(\'comments\')->where(\'operadora_id\', \'=\', $id)->count() }}')

        ->add_column('actions', '<a href="{{{ URL::to(\'admin/operadoras/\' . $id . \'/edit\' ) }}}" class="btn btn-default btn-xs iframe" >{{{ Lang::get(\'button.edit\') }}}</a>
                <a href="{{{ URL::to(\'admin/operadoras/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger iframe">{{{ Lang::get(\'button.delete\') }}}</a>
            ')

        ->remove_column('id')

        ->make();
    }

}