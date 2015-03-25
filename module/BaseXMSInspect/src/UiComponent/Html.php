<?php 

namespace BaseXMSInspect\UiComponent;

class Html extends \BaseXMS\UiComposer\UiComponent\Html
{
	
	protected function getCssFileContent()
	{
		$content = parent::getCssFileContent();
		return $content . file_get_contents( 'module/BaseXMSInspect/public/css/inspect.css' );
	}
}

?>