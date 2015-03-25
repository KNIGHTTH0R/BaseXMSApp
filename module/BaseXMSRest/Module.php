<?php

namespace BaseXMSRest;

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
		
    public function getConfig()
    {
    		return include __DIR__ . '/config/module.config.php';
    }
}
