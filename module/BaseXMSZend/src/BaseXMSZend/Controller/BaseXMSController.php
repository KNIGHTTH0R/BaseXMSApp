<?php

namespace BaseXMSZend\Controller;

die( 'not used anymore' );

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel,
    Zend\Stdlib\RequestInterface as Request,
    Zend\Stdlib\ResponseInterface as Response,
    BaseXMS\Application as BaseXMSApp;
use BaseXMS\SiteAccess;

class BaseXMSController extends AbstractActionController
{
	
	public function dispatch( Request $request, Response $response = null )
	{
		#if (!$response) {
		#	$response = new HttpResponse();
		#}

		$application = $this->getEvent()->getApplication();
		$routeMatch  = $this->getEvent()->getRouteMatch();
		
		
		$appConfig = $application->getServiceManager()->get( 'ApplicationConfig' );
		
		$siteaccesses = isset( $appConfig[ 'siteaccesses' ] ) ? $appConfig[ 'siteaccesses' ] : array();
		
		$siteAccess = $this->siteaccessFactory( $routeMatch->getParam( 'context' ),
		                                        $siteaccesses,
		                                        $application );

		$baseXMSResponse = $siteAccess->buildResponse( $routeMatch->getParam( 'path' ) );
		
		return $baseXMSResponse;
	}
	
	private function siteaccessFactory( $context, $siteaccesses, $application )
	{
		$class = '\BaseXMS\SiteAccess';
		
		if( !empty( $siteaccesses ) )
		{
			if( isset( $siteaccesses[ $context ] ) )
			{
				if( class_exists( $siteaccesses[ $context ] ) )
				{
					$class = $siteaccesses[ $context ];
				}
			}
		}
		
		$instance = new $class;
		$instance->init( $application );
		
		return $instance;
	}
}
