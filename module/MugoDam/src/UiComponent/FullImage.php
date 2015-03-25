<?php 

namespace MugoDam\UiComponent;

use BaseXMS\UiComposer\UiComponent\HtmlWidget;
use BaseXMS\FC;

class FullImage extends HtmlWidget
{
	protected function getXml()
	{
		$refId = $this->getContext()->queryToValue( '//refid' );
		$contentObject = $this->getObjectByReference( $refId );
		$srcValue = $contentObject->queryToValue( '//source' );
		
		return
'<div class="text-center">
	<a href="'. FC::link( '/' ) .'">back</a>
	<img src="'. $srcValue .'" alt="" />
</div>';
	}
}

?>