<?php 
namespace BaseXMSInspect;

class SiteAccess extends \BaseXMS\Mvc\SiteAccess
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function dispatch( $path )
	{
		parent::dispatch( $path );
		
		$this->baseXMSResponse->contentclass = '\BaseXMS\RequestHandler\UiComposer';
	
		return $this;
	}
	
}

?>