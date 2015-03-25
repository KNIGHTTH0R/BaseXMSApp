<?php 

use Zend\Config\Config;
use BaseXMS\SiteAccess;

class TestSiteAccess extends SiteAccess
{
	protected function addConfig()
	{
		return new Config( array( 'BaseX' => array( 'host' => 'doesnotexists' ) ) );
	}
}

?>