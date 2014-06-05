<?php

class AdminDashboardController extends AdminController {

   /***
	 * Admin dashboard
	 *
	***/
	public function getIndex()
	{
		if(! Session::has('trimestre') ){
			$quarter = ceil(date('m')/3);
			Session::put('trimestre', date('Y').'0'.$quarter );
		}
        return View::make('admin/dashboard');
	}

	public function getTrimestre($qual){
    	Session::put('trimestre', $qual);
    	return View::make('admin/dashboard');
    }

}