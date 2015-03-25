<?php

include_once( 'BaseXMSTest.php' );

class UrlDispatcherTest extends BaseXMSTest
{
	public function setUp()
	{
		parent::setUp();
				
		$this->urlDispatcher = new BaseXMS\Mvc\UrlDispatcher();
		$this->urlDispatcher->setServiceLocator( $this->services );
	}

	public function testGetResponses()
	{
		$expected = '<dispatchResult><code>200</code><id>4</id><contentclass>\BaseXMS\RequestHandler\UiComposer</contentclass><path>1/4</path></dispatchResult>';
		
		$data = $this->urlDispatcher->dispatch( '/world' );
		$this->assertXmlStringEqualsXmlString(
				$expected, $data->saveXML( $data->firstChild ) );

		$data = $this->urlDispatcher->dispatch( '/world2' );
		$this->assertXmlStringEqualsXmlString(
				$expected, $data->saveXML( $data->firstChild ) );
		
		// oldPath
		$expected = '<dispatchResult><code>301</code><id></id><contentclass></contentclass><path>/usa</path></dispatchResult>';

		$data = $this->urlDispatcher->dispatch( '/usa4' );
		$this->assertXmlStringEqualsXmlString(
				$expected, $data->saveXML( $data->firstChild ) );

		$expected = '<dispatchResult><code>301</code><id></id><contentclass></contentclass><path>/usa/politics2</path></dispatchResult>';

		$data = $this->urlDispatcher->dispatch( '/usa4/politics2' );
		$this->assertXmlStringEqualsXmlString(
				$expected, $data->saveXML( $data->firstChild ) );
		
	
		// root node
		$expected = '<dispatchResult><code>200</code><id>1</id><contentclass>\BaseXMS\RequestHandler\UiComposer</contentclass><path>/</path></dispatchResult>';
		
		$data = $this->urlDispatcher->dispatch( '/' );
		$this->assertXmlStringEqualsXmlString(
				$expected, $data->saveXML( $data->firstChild ) );

		$data = $this->urlDispatcher->dispatch( '' );
		$this->assertXmlStringEqualsXmlString(
				$expected, $data->saveXML( $data->firstChild ) );

		$data = $this->urlDispatcher->dispatch( null );
		$this->assertXmlStringEqualsXmlString(
				$expected, $data->saveXML( $data->firstChild ) );


		// altFullPath
		$expected = '<dispatchResult><code>200</code><id>3</id><contentclass>\BaseXMS\RequestHandler\UiComposer</contentclass><path>1/2/3</path></dispatchResult>';
		
		$data = $this->urlDispatcher->dispatch( '/fips/tests/politics' );
		$this->assertXmlStringEqualsXmlString(
				$expected, $data->saveXML( $data->firstChild ) );

		
		// oldFullPath
		$expected = '<dispatchResult><code>301</code><id>3</id><contentclass>\BaseXMS\RequestHandler\UiComposer</contentclass><path>1/2/3</path></dispatchResult>';
		
		$data = $this->urlDispatcher->dispatch( '/fips/tests/politics3' );
		$this->assertXmlStringEqualsXmlString(
				$expected, $data->saveXML( $data->firstChild ) );

		
		// 404
		$expected = '<dispatchResult><code>400</code></dispatchResult>';
		
		$data = $this->urlDispatcher->dispatch( '/does/not/exists' );
		$this->assertXmlStringEqualsXmlString(
				$expected, $data->saveXML( $data->firstChild ) );
		
	}

	/*
	public function testConnectionErrors()
	{
		include_once( 'tests/helpers/TestSiteAccess.php' );
		$siteaccess = SiteAccessFactory::factory( 'test', array( 'test' => 'TestSiteAccess' ) );
		
		$this->urlDispatcher = new BaseXMS\UrlDispatcher();
		$this->urlDispatcher->setServiceLocator( $this->serviceManager );
		
		$expected = '<dispatchResult><code>500</code></dispatchResult>';
		$data = $this->urlDispatcher->dispatch( '/world' );
		$this->assertXmlStringEqualsXmlString(
				$expected, $data->asXML() );
		
	}
	*/
	
}

?>