<?php 

namespace BaseXMSZend\Router;

use Zend\Mvc\Router\Http\RouteInterface,
    Zend\Stdlib\RequestInterface as Request,
    Zend\Mvc\Router\Http\RouteMatch;

class BaseXMS implements RouteInterface
{	
	public static function factory( $options = array() )
	{
		return new static();
	}
	
	public function match( Request $request, $pathOffset = null )
	{
		$requestPath = substr( $request->getRequestUri(), $pathOffset );
		
		//Cut get parameters
		$requestPath = preg_replace( '/\?.*$/', '', $requestPath );
		
		$regex = '(\G(\/:(?<context>.*?)|)((?<path>\/.*?)|)(\/|)$)';
		preg_match( $regex, $requestPath, $matches );
		
		$options = array( 'controller' => 'index',
		                  'context'    => $matches[ 'context' ],
		                  'path'       => $matches[ 'path' ]
		                );

		return new RouteMatch( $options, strlen( $requestPath ) );
	}
	
	public function assemble(array $params = array(), array $options = array())
	{
		return $this->route;
	}
	
	public function getAssembledParams()
	{
		return array();
	}
}

?>