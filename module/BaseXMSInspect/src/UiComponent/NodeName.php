<?php 

namespace BaseXMSInspect\UiComponent;

use BaseXMS\UiComposer\UiComposer;
use BaseXMS\UiComposer\UiComponent\HtmlWidget;
use BaseXMS\Stdlib\DOMXPath;

class NodeName extends HtmlWidget
{
	protected function getXml()
	{
		$ref = $this->getContext()->queryToValue( '//ref' );

		$entry = $this->getObjectByReference( $ref );

		$xpath = new DOMXPath( $entry->ownerDocument );

		$name = $xpath->queryToValue( './/content/name', $entry );
		
		// Use path instead
		if( !$name )
		{
			$path = $xpath->queryToValue( './/path', $entry );
			$pathParts = explode( '/', $path );
			$name = $pathParts[ ( count( $pathParts ) -1 ) ];
		}

		// fall back to some string
		if( !$name )
		{
			$name = '&#60;not named&#62;';
		}
		
		return $name;
	}
}

?>