<?php 
namespace MugoDam\Mvc;

use Zend\Config\Config;

class SiteAccess extends \BaseXMS\Mvc\SiteAccess
{
	public function dispatch( $path )
	{
		parent::dispatch( $path );
		
		$this->baseXMSResponse->contentclass = '\BaseXMS\RequestHandler\UiComposer';
	
		return $this;
	}
	
	protected function addConfig()
	{
		return new Config( array(
				'BaseX'   => array( 'db' => 'MugoDam' ),
				'designs' => array( 0 => 'mugodam' ),
		) );
	}
	
}

?>