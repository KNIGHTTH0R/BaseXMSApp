<?php 
include 'init_autoloader.php';

#$serviceManager = new ServiceManager();
#$serviceManager->setFactory( 'xmldb', 'BaseXMS\BaseXFactory' );
#$serviceManager->setFactory( 'log', 'BaseXMS\Log\Factory' );
//$serviceManager->setService( 'config', $config );
#$serviceManager->setService( 'accumulator', new Accumulator() );
#$serviceManager->setService( 'user', new User() );

$cache = new \BaseXMS\Cache\Storage\Adapter\Filesystem();
$cache->setOptions( array( 'cache_dir' => 'data/cache' ) );

$cache->getOptions()->setTtl( 10 );
$cache->ClearExpired();

?>