<?php

use BaseXMS\DataObjectHandler\AccessPaths;

include_once( 'BaseXMSTest.php' );

class AccessPathsTest extends BaseXMSTest
{
	private $accessPathsHandler;
	
	public function setUp()
	{
		parent::setUp();
						
		// Getting AccessPathsHandler
		$this->accessPathsHandler = new AccessPaths();
		$this->accessPathsHandler->setServiceLocator( $this->services );
	}
	
	public function testRead()
	{
		$expectedXml =
<<<XML
<?xml version="1.0"?>
<node id="3">
  <accessPaths class="\BaseXMS\RequestHandler\UiComposer">
    <entry type="main" path="politics"/>
    <entry type="alt" path="politics2"/>
    <entry type="altFull" path="/fips/tests/politics"/>
    <entry type="old" path="politics3">politics2</entry>
    <entry type="oldFull" path="/fips/tests/politics3"/>
  </accessPaths>
</node>
XML;

		$result = $this->accessPathsHandler->read( 3, 'text' );
		$this->assertXmlStringEqualsXmlString( $expectedXml, $result );
	}

	public function testWrite()
	{
		$input = '<node id="3"><accessPaths class="\BaseXMS\RequestHandler\UiComposer">
		<entry type="main" path="politics"></entry>
		<entry type="alt" path="politics2"></entry>
	    <entry type="altFull" path="/fips/tests/politics"></entry>
		<entry type="old" path="politics3">politics2</entry>
	    <entry type="oldFull" path="/fips/tests/politics3"></entry>
		</accessPaths></node>';

		$doc = new DOMDocument();
		$doc->loadXML( $input );
		
		$result = $this->accessPathsHandler->update( $doc );
	}
}

?>