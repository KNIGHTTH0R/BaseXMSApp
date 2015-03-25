<?php 

namespace BaseXMSInspect\UiComponent;

use BaseXMS\UiComposer\UiComposer;
use BaseXMS\UiComposer\UiComponent\HtmlWidget;
use BaseXMS\Stdlib\DOMXPath;
use BaseXMS\FC;

class Row extends HtmlWidget
{
	protected function getXml()
	{
		$ref = $this->getContext()->queryToValue( '//ref' );

		$entry = $this->getObjectByReference( $ref );

		$xpath = new DOMXPath( $entry->ownerDocument );

		$name = $xpath->queryToValue( './/sort', $entry );
		$name = $name ? $name : '&#60;not named&#62;';

		$url = FC::link( $xpath->queryToValue( './/path', $entry ) );
		
		return
'<tr>
	<td>
		<a href="'. $url .'">
			<include type="nodeName" ref="'. $ref .'" />
		</a>
	</td>
</tr>';
	}
}

?>