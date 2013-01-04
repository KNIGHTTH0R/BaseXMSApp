<?php
/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
chdir(dirname(__DIR__));

define( 'SCRIPT_START', microtime( true ) );

ob_start();

// Setup autoloading
include 'init_autoloader.php';

// Run the application!
$response = Zend\Mvc\Application::init( include 'config/application.config.php' )->run();


// Print out overall timing
$a = new BaseXMS\Accumulator();
$a->start( 'Overall', SCRIPT_START );
$a->stop( 'Overall' );

$a->memory_usage( 'Before sending response' );
echo $a->getDataAsHtml();

$debug = '<div id="echo-output"><h2>Echo Output</h2>' . ob_get_contents() . '</div>';
ob_end_clean();

// We did not register a render or finish event but we send the response here
$response->send();

echo $debug;
echo memory_get_peak_usage();
