<?php 

return array( 
	
	/*
	|--------------------------------------------------------------------------
	| oAuth Config
	|--------------------------------------------------------------------------
	*/

	/**
	 * Storage
	 */
	'storage' => 'Session', 

	/**
	 * Consumers
	 */
	'consumers' => array(

		/**
		 * Facebook
		 */
        'Facebook' => array(
            'client_id'     => '',
            'client_secret' => '',
            'scope'         => array(),
        ),	

        /**
		 * Facebook
		 */
        'Google' => array(
            'client_id'     => '661084662595-r2oplrqh851728v36ml5hf9dhkdevd5i.apps.googleusercontent.com',
            'client_secret' => 'AIzaSyALfeuT6J0HyyAw8vFGySFsWiWY1-LoSwE',
            'scope'         => array('userinfo_email', 'userinfo_profile'),
        ),		

	)

);