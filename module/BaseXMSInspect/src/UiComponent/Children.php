<?php 

namespace BaseXMSInspect\UiComponent;

use BaseXMS\UiComposer\UiComposer;
use BaseXMS\UiComposer\UiComponent\HtmlWidget;
use BaseXMS\Stdlib\DOMXpath;
use BaseXMS\FC;

class Children extends HtmlWidget
{
	protected function getXml()
	{
		$nodeId = $this->uiComposer->getContextData()->queryToValue( '//dispatchResult/id' );

		// fetch data for all rows
		$dataHandler = new \BaseXMS\DataObjectHandler\ContentObject();
		$dataHandler->setServiceLocator( $this->uiComposer->getServices() );
		
		$data = $dataHandler->search( '//node[@id="'. $nodeId .'"]/node', '', '', '' );
				
		$return =
'<div class="inspect-children">
<table class="table table-striped table-hover table-bordered">
<caption>Children</caption>
<thead>
	<tr>
		<th>Name</th>
	</tr>
</thead>';
		
		$index = 0;
		$return .= '<tbody>';
		//TODO: real parent here
		$return .= '<tr><td><a href="'. FC::link( '/' ) .'">..</a></td></tr>';
		foreach( $data as $entry )
		{
			$refId = $this->referenceObject( $entry );
			$return .= '<include type="row" ref="'. $refId .'" />';
			
			$index++;
		}
		$return .= '</tbody>';
		$return .= '</table>';
		$return .= '</div>';
		
		return $return;
	}
}

?>