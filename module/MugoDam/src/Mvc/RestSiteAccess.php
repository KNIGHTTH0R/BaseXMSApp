<?php 
namespace MugoDam\Mvc;

use Zend\Config\Config;

class RestSiteAccess extends \BaseXMSRest\Mvc\SiteAccess
{	
	protected function addConfig()
	{
		return new Config( array( 'BaseX' => array( 'db' => 'MugoDam' ) ) );
	}
}

?>