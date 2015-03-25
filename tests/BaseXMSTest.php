<?php 

use Zend\ServiceManager\ServiceManager;
use BaseXMS\Stdlib\DOMDocument;
use BaseXMS\SiteAccessFactory;
use BaseXMS\User;

class BaseXMSTest extends PHPUnit_Framework_TestCase
{
	protected $services;
	
	public function setUp()
	{
		include 'init_autoloader.php';
		$this->services = $this->getServices();

		// create unittest DB
		$xmlFile = dirname(__FILE__) . '/var/unittests.xml';
		$this->services->get( 'xmldb' )->execute( 'CREATE DB UnitTests "'. $xmlFile .'"', 'text', '', false );
	}

	protected function getServices()
	{
		$config = array( 'BaseX' => array() );

		$serviceManager = new ServiceManager();
		$serviceManager->setFactory( 'xmldb', 'BaseXMS\BaseXFactory' );
		$serviceManager->setFactory( 'log', 'BaseXMS\Log\Factory' );
		$serviceManager->setFactory( 'accumulator', 'BaseXMS\Debug\Factory' );
		$serviceManager->setService( 'config', $config );
		$serviceManager->setService( 'user', new User( 0 ) );

		// Setup custom logging
		$writer = new Zend\Log\Writer\Stream( 'data/log/unittest.log' );
		$serviceManager->get( 'log' )->addWriter( $writer );

		return $serviceManager;
	}
	
	public function tearDown()
	{
		$this->services->get( 'xmldb' )->execute( 'DROP DB UnitTests', 'text', '', false );
	}
}

?>