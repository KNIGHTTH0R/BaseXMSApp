<?php
return array(
    'modules' => array(
		'BaseXMSZend',
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
	#'service_manager' => array(
#			'factories' => array(
#				'Application' => 'BaseXMS\Application'
#			)
#	),
	'servicelistener' => array(
			'defaultServiceConfig' => array(
					'factories' => array(
							'Application' => 'BaseXMS\Application'
					)
			)
	)
);
