<?php 
namespace BaseXMSRest\Mvc;

use BaseXMS\Stdlib\DOMDocument;

use Zend\Config\Config;

class SiteAccess extends \BaseXMS\Mvc\SiteAccess
{
	/**
	 * Valid RESTFUL paths contain /<requestHandler>/<function>
	 * Paramters should be submitted as GET or POST
	 */
	public function dispatch( $path )
	{
		$parts = explode( '/', $path );

		// We require at least a module and a function for REST requests
		if( count( $parts ) >= 3 )
		{
			$keyToRequestHandlerMap = array(
					'node' => 'BaseXMSRest\RequestHandler\RestNode'
			);
			
			if( isset( $keyToRequestHandlerMap[ $parts[ 1 ] ] ) )
			{
				$requestHandler = $keyToRequestHandlerMap[ $parts[ 1 ] ];
				$function       = $parts[ 2 ];
			}
			else
			{
				//TODO: log it
				$requestHandler = 'BaseXMSRest\RequestHandler\Rest';
				$function       = 'default';
			}
			
			$xml =
			'<dispatcherResponse>
				<function>'. $function .'</function>
				<code>200</code>
				<contentclass>'. $requestHandler .'</contentclass>
			</dispatcherResponse>';
		}
		else
		{
			$xml =
			'<dispatcherResponse>
			<code>400</code>
			<contentclass>BaseXMSRest\RequestHandler\Rest</contentclass>
			</dispatcherResponse>';
		}
		
		$this->baseXMSResponse = new DOMDocument();
		$this->baseXMSResponse->loadXML( $xml );
		
		return $this;
	}
}

?>