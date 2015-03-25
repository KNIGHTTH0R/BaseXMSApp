<?php 

use Zend\ServiceManager\ServiceManager;
use BaseXMS\User;

include 'init_autoloader.php';

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


?>