<?php 

namespace MugoDam\UiComponent;

use BaseXMS\DataObjectHandler\ContentObject;
use BaseXMS\UiComposer\UiComposer;
use BaseXMS\UiComposer\UiComponent\HtmlWidget;

class Content extends HtmlWidget
{
	protected function getXml()
	{
		$contextNodeId = $this->uiComposer->getContextData()->queryToValue( '//dispatchResult/id' );
		
		$contentObjectHandler = new ContentObject();
		$contentObjectHandler->setServiceLocator( $this->getUiComposer()->getServiceLocator() );
		$contentObject = $contentObjectHandler->read( $contextNodeId, 'xml' );

		$refId = $this->referenceObject( $contentObject );
		
		//TODO: isn't there a way to query to an attribute values?
		$contentElement = $contentObject->query( '//content' )->item(0);
		$class = $contentElement->getAttribute( 'class' );
				
		return '
<div class="content">
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12">
				<include type="full" refid="'. $refId .'" class="'. $class .'" />
			</div>

			<hr />
		</div>
      
		<footer>
			<p>Mugo DAM 2013</p>
		</footer>
	</div>
</div>';
	}
}

?>