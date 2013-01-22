<?php
return array(
	    'router' => array(
	        'routes' => array(
	            'default' => array(
	                'type'    => 'BaseXMSZend\Router\BaseXMS'
	            ),
	        ),
	    ),
	
		'siteaccesses' => array(
				'' => '\BaseXMS\SiteAccess' //default access
		),
		
		'designs' => array(
				0 => 'base'
		),
		
		'designrules' => array(
				'base' => array(
						'/context/type[text() = "html"]' => '\BaseXMS\UiComponent\Html',
						'/context/type[text() = "head"]' => '\BaseXMS\UiComponent\Head',
						'/context/type[text() = "body"]' => '\BaseXMS\UiComponent\Body',
						'/context/type[text() = "debug"]' => '\BaseXMS\UiComponent\Debug',
						'/context/type[text() = "content"]' => '\BaseXMS\UiComponent\Content',
						'/context/type[text() = "inline-css"]' => '\BaseXMS\UiComponent\Head\InlineCss'
				)
		)
);
