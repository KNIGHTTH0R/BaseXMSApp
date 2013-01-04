<?php
return array(
    'router' => array(
        'routes' => array(
            'default' => array(
                'type'    => 'BaseXMSZend\Router\BaseXMS'
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'index' => 'BaseXMSZend\Controller\BaseXMSController'
        ),
    ),
	'fips' => array( 1 => 'b' ),
);
