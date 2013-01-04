<?php
return array(
    'modules' => array(
        'BaseXMSZend',
    		'BaseXMSInspect',
    		'Sandbox',
    		//'Application',
    ),
    'module_listener_options' => array(
        'config_glob_paths'    => array(
            'config/autoload/{,*.}{global,local}.php',
        ),
        'module_paths' => array(
            './module',
            './vendor',
        ),
    ),	
	// TODO: find a way to override the normal Application Factory process
	'service_listener_optionsd' => array(
			'service_manager' => 'application',
	),
);
