<?php 
namespace BaseXMSInspect\UiComponent;

class Settings extends \BaseXMS\UiComposer\UiComponent\UiComponent
{
	public function getDOMNode( $services )
	{
		$content  = '<body><pre>';
		$content .= print_r( $services->get( 'application' )->getConfig(), true );
		$content .= '</pre></body>';
		
		$doc = new \DOMDocument();
		$doc->loadXML( $content );
		
		return $doc->firstChild;
	}
}

?>