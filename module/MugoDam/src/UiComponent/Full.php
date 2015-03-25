<?php 

namespace MugoDam\UiComponent;

use BaseXMS\UiComposer\UiComponent\HtmlWidget;
use BaseXMS\FC;

class Full extends HtmlWidget
{
	protected function getXml()
	{
		$nodeId = $this->uiComposer->getContextData()->queryToValue( '//dispatchResult/id' );
		
		// fetch data for all rows
		$dataHandler = new \BaseXMS\DataObjectHandler\ContentObject();
		$dataHandler->setServiceLocator( $this->uiComposer->getServices() );

		$data = $dataHandler->search( '//node[@id="'. $nodeId .'"]/node', '', '', '' );

		$return =
'<div id="myCarousel" class="carousel slide">
	<div class="carousel-inner">';
		
		foreach( $data as $index => $entry )
		{
			$active = $index == 0 ? 'active' : '';
			
			$doc = new \BaseXMS\Stdlib\DOMDocument();
			$doc->loadXML( $entry->ownerDocument->saveXML( $entry ) );
			
			$refId = $this->referenceObject( $doc );
			$return .= '<div class="item '. $active .'"><include type="full" class="image" refid="'. $refId .'" /></div>';
		}
		$return .= 
	'</div>
	
	<a class="carousel-control left" href="#myCarousel" data-slide="prev">..</a>
	<a class="carousel-control right" href="#myCarousel" data-slide="next">..</a>
	
</div>';
		
		return $return;
	}
}

?>