<?php
/**
 * Opauth basic configuration file to quickly get you started
 * ==========================================================
 * To use: rename to opauth.conf.php and tweak as you like
 * If you require advanced configuration options, refer to opauth.conf.php.advanced
 */

$config = array(
/**
 * Path where Opauth is accessed.
 *  - Begins and ends with /
 *  - eg. if Opauth is reached via http://example.org/auth/, path is '/auth/'
 *  - if Opauth is reached via http://auth.example.org/, path is '/'
 */
	'path' => '/bow/auth/',

/**
 * Callback URL: redirected to after authentication, successful or otherwise
 */
	'callback_url' => '{path}callback.php',
	
/**
 * A random string used for signing of $auth response.
 */
	'security_salt' => '65gh4ty4hbt2hv53dtv2yj24udtvhyvg6jdt6h42ty6hv7trh7y687t1gvr87gqer687ilp',
		
/**
 * Strategy
 * Refer to individual strategy's documentation on configuration requirements.
 * 
 * eg.
 * 'Strategy' => array(
 * 
 *   'Facebook' => array(
 *      'app_id' => 'APP ID',
 *      'app_secret' => 'APP_SECRET'
 *    ),
 * 
 * )
 *
 */
	'Strategy' => array(
		'Google' => array(
            'client_id' => '173738166737-tava0us92luj8c551lfks6uatpp3torr.apps.googleusercontent.com',
            'client_secret' => '2ohwQkYX-vy2k2-pDW2AUOz9'
        ),
        'Facebook' => array(
            'app_id' => '481496998592209',
            'app_secret' => '2af4d71df641bf01f3f24c6c50f67b33'
        ),
        'Twitter' => array(
            'key' => 'KEs3znfS6SOjIc85htCLw',
            'secret' => 'y9DwE9TexwI2PQHRMpNDkVfGFFtMrbC1ld05iOBfmII'
        )       
	),
);