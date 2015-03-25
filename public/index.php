<?php
use BaseXMS\Mvc\Application;

define( 'SCRIPT_START', microtime( true ) );

chdir(dirname(__DIR__));

// Capture all direct output and shows it at the end of the html doc
$buffer = '';
ob_start();
{
	// Setup autoloading
	include 'init_autoloader.php';
	
	// Run the application!
	$application = Application::init();
	$response = $application->route()->setSiteAccess()->getResponse();
	
	if( ob_get_length() )
	{
		$buffer = '<div id="echo-output"><h2>Echo Output</h2><pre>' . ob_get_contents() . '</pre></div>';
	}
}
ob_end_clean();
	
$response->send();

echo $buffer;

?>