<?php 

namespace BaseXMSInspect\UiComponent;

use BaseXMS\DataObjectHandler\ContentObject;
use BaseXMS\UiComposer\UiComposer;
use BaseXMS\UiComposer\UiComponent\HtmlWidget;

class Full extends HtmlWidget
{
	protected function getXml()
	{
		$refId = $this->getContext()->queryToValue( '//refid' );
		
		$contentObject = $this->getObjectByReference( $refId );
		$htmlOutput = htmlentities( $contentObject->saveXML() );
		
		return '
<div class="hero-unit">
	<pre>' . $htmlOutput . '</pre>
</div>';
	}
}

?>