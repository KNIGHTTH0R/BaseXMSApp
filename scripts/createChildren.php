<?php 

use BaseXMS\DataObjectHandler\Node;
use BaseXMS\Stdlib\DOMDocument;
use BaseXMS\DataObjectHandler\ContentObject;

$services = include( 'scripts/env.php' );

$nodeHandler = new Node();
$nodeHandler->setServiceLocator( $services );

$contentHandler = new ContentObject();
$contentHandler->setServiceLocator( $services );

for( $i = 1; $i < 100; $i++ )
{
	$nodeId = $nodeHandler->create( 5 );

	$content = 
'<node id="'. $nodeId .'">
	<content>
		<name>Instance '. $i .'</name>
		<raw></raw>
	</content>
</node>';
	
	$doc = new DOMDocument();
	$doc->loadXML( $content );
	
	$contentHandler->update( $doc );
}

?>