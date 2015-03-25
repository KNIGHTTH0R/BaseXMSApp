<?php 

namespace BaseXMSRest\RequestHandler;

use Zend\Http\PhpEnvironment\Response as ZendResponse;
use Zend\Http\Headers;
use BaseXMS\RequestHandler\RequestHandler;

class Rest extends RequestHandler
{
	public function getResponse()
	{
		$response = new ZendResponse();

		$function = $this->context->queryToValue( '//function' );
		
		var_dump( $function );
		$methodVariable = array( $this, $function );
		
		if( is_callable( $methodVariable, false ) )
		{
			$response = call_user_func( $methodVariable );
			
			var_dump( $response ); die('dd');
		}
		else
		{
			
			$response->setContent( 'invalid function' );
			$response->setStatusCode( 200 );
		}
		
		return $response;
	}
}

?>