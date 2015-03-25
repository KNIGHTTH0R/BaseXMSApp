<?php

namespace BaseXMSInspect;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface as AutoloaderProvider;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\EventManager\EventInterface;

use BaseXMS\Log\Mock;
use BaseXMS\Log\Logger;

class Module implements AutoloaderProvider
{
	public function getAutoloaderConfig()
	{
		return array(
				'Zend\Loader\ClassMapAutoloader' => array(
						__DIR__ . '/autoload_classmap.php',
				),
				'Zend\Loader\StandardAutoloader' => array(
						'namespaces' => array(
								__NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
						),
				),
		);
	}
	
	public function init( $moduleManager )
	{
		$moduleManager->getEventManager()->attach( 'AddLogWriter', function( $e )
		{
			$logger = $e->getParams();
				
			$filter = new \BaseXMSInspect\Log\Filter();
			$writer = new Mock;
	
			$writer->setName( 'PHP Errors and above warnings' );
			$writer->addFilter( $filter );
				
			$logger->addWriter( $writer );
		});
	}
	
    public function getConfig()
    {
    		return include __DIR__ . '/config/module.config.php';
    }
}
