<?php 

namespace BaseXMSRest\RequestHandler;

use Zend\Http\PhpEnvironment\Response as ZendResponse;
use Zend\Http\Headers;
use BaseXMS\Stdlib\DOMDocument;
use BaseXMS\RequestHandler\RequestHandler;
use BaseXMS\DataObjectHandler\Node;
use BaseXMS\DataObjectHandler\ContentObject;

class RestNode extends Rest
{
	/**
	 * creates a node 
	 */
	public function create()
	{
		$response = new ZendResponse();

		$nodeHandler = new Node();
		$nodeHandler->setServiceLocator( $this->getServiceLocator() );

		$parentId = isset( $_REQUEST[ 'parentId' ] ) ? $_REQUEST[ 'parentId' ] : false;
		
		try
		{
			$nodeXml = $nodeHandler->create( $parentId );
			
			$response->setContent( $nodeXml );
			$response->setStatusCode( 200 );
		}
		catch( \Exception $e )
		{
			$response->setStatusCode( 500 );
			$response->setContent( $e->getMessage() );
		}
		
		return $response;
	}
	
	public function read()
	{
		$response = new ZendResponse();
		
		$nodeHandler = new Node();
		$nodeHandler->setServiceLocator( $this->getServiceLocator() );
		
		$id = isset( $_REQUEST[ 'id' ] ) ? $_REQUEST[ 'id' ] : false;
		
		try
		{
			$nodeXml = $nodeHandler->read( $id );
				
			$response->setContent( $nodeXml );
			$response->setStatusCode( 200 );
		}
		catch( \Exception $e )
		{
			$response->setStatusCode( 500 );
			$response->setContent( $e->getMessage() );
		}
		
		return $response;
	}
	
	
	public function delete()
	{
		$response = new ZendResponse();
		
		$nodeHandler = new Node();
		$nodeHandler->setServiceLocator( $this->getServiceLocator() );
		
		$id = isset( $_REQUEST[ 'id' ] ) ? $_REQUEST[ 'id' ] : false;
		
		try
		{
			$nodeXml = $nodeHandler->delete( $id );
		
			$response->setContent( $nodeXml );
			$response->setStatusCode( 200 );
		}
		catch( \Exception $e )
		{
			$response->setStatusCode( 500 );
			$response->setContent( $e->getMessage() );
		}
		
		return $response;
	}
	
	/**
	 * TODO: did some refactoring but didn't test it. Probably broken currently
	 * TODO: move all logic into the data API and just build a simple wrapper
	 * 
	 * @return \Zend\Http\PhpEnvironment\Response
	 */
	public function addwithcontent()
	{
		$response = new ZendResponse();

		$this->responseContent  = array(
				'success' => false,
				'error'   => false
		);
		
		$nodeHandler = new Node();
		$nodeHandler->setServiceLocator( $this->getServiceLocator() );
		
		$parentId = isset( $_REQUEST[ 'parentId' ] ) ? $_REQUEST[ 'parentId' ] : false;
				
		try
		{
			$id = $nodeHandler->create( $parentId );
				
			$this->responseContent[ 'id' ] = $id;
				
			// adding content
			$contentXml = $_REQUEST[ 'data' ];
				
			if( $contentXml )
			{
				$xml = '<node id="'. $id .'">'. $contentXml . '</node>';
					
				$doc = new DOMDocument();
				$parseSuccess = $doc->loadXML( $xml );
					
				if( $parseSuccess )
				{
					$contentHandler = new ContentObject();
					$contentHandler->setServiceLocator( $this->getServiceLocator() );
						
					try
					{
						$updateResult = $contentHandler->update( $doc );
		
						$this->responseContent[ 'success' ] = true;
						$response->setStatusCode( 200 );
					}
					catch( \Exception $e )
					{
						$this->responseContent[ 'error' ] = $e->getMessage();
					}
				}
				else
				{
					$this->responseContent[ 'error' ] = 'Unable to parse given data.';
				}
			}
			else
			{
				$this->responseContent[ 'error' ] = 'No data was provided';
			}
		}
		catch( \Exception $e )
		{
			$this->responseContent[ 'error' ] = $e->getMessage();
		}

		$response->setContent( json_encode( $this->responseContent ) );
		
		return $response;
	}	
}

?>