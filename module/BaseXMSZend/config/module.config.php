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
				'' => '\BaseXMS\Mvc\SiteAccess' //default access
		),
		
		'designs' => array(
				0 => 'base'
		),
		
		'designrules' => array(
				'base' => array(
						'/context/type[text() = "root"]'        => '\BaseXMS\UiComposer\UiComponent\Root',
						'/context/type[text() = "html"]'        => '\BaseXMS\UiComposer\UiComponent\Html',
						'/context/type[text() = "head"]'        => '\BaseXMS\UiComposer\UiComponent\Head',
						'/context/type[text() = "body"]'        => '\BaseXMS\UiComposer\UiComponent\Body',
						'/context/type[text() = "debug"]'       => '\BaseXMS\UiComposer\UiComponent\Debug\Debug',
						'/context/type[text() = "logging"]'     => '\BaseXMS\UiComposer\UiComponent\Debug\Logging',
						'/context/type[text() = "accumulator"]' => '\BaseXMS\UiComposer\UiComponent\Debug\Accumulator',
						'/context/type[text() = "content"]'     => '\BaseXMS\UiComposer\UiComponent\Content',
						'/context/type[text() = "css-inline"]'  => '\BaseXMS\UiComposer\UiComponent\Head\CssInline',
						'/context/type[text() = "css-file"]'    => '\BaseXMS\UiComposer\UiComponent\Head\CssFile',
						'/context/type[text() = "jsfile"]'      => '\BaseXMS\UiComposer\UiComponent\Head\JsFile',
				)
		)
);
