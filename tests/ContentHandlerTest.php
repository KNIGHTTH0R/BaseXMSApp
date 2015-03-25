<?php

use BaseXMS\Stdlib\DOMDocument;
use BaseXMS\DataObjectHandler\ContentObject;

include_once 'BaseXMSTest.php';

class ContentHandlerTest extends BaseXMSTest
{
	private $contentHandler;
	
	public function setUp()
	{
		parent::setUp();
	
		// Getting contentHandler
		$this->contentHandler = new ContentObject();
		$this->contentHandler->setServiceLocator( $this->services );
	}
	
	public function testRead()
	{
		// read node 1
		$expected =
<<<XML
<node id="1">
  <path>/</path>
  <content class="">
    <sort>0000001</sort>
    <raw>Hello<b>beautiful</b>World!!</raw>
  </content>
</node>
XML;
		$data = $this->contentHandler->read( 1 );
		$this->assertXmlStringEqualsXmlString( $expected, $data );
	}
	
	public function testUpdate()
	{
		
		// update valid content xml
		$xml = '<node id="2"><content><name>fips</name><sort>fips</sort><raw>fips <b>test1</b></raw></content></node>';
		$doc = new DOMDocument();
		$doc->loadXML( $xml );
		
		$result = $this->contentHandler->update( $doc );
		$this->assertTrue( $result );

		// update valid content with text nodes and comment nodes
		$xml =
'<node id="2">
	<!-- Comment -->
	<content>
		<name>fips</name>
		<sort>fips</sort>
		<raw>fips <b>test1</b></raw>
	</content>
</node>';
		
		$doc = new DOMDocument();
		$doc->loadXML( $xml );
		
		$result = $this->contentHandler->update( $doc );
		$this->assertTrue( $result );
		
		// update valid content xml but non-existing node id
		/* TODO: need something like this:
		 * try {
            // ... Code that is expected to raise an exception ...
        }
 
        catch (InvalidArgumentException $expected) {
            return;
        }
 
        $this->fail('An expected exception has not been raised.');
		$xml = '<node id="-1"><content><name>fips</name><sort>fips</sort><raw>fips <b>test</b></raw></content></node>';
		$doc = new DOMDocument();
		$doc->loadXML( $xml );
		
		$result = $contentHandler->update( $doc );
		$this->assertTrue( $result );

		 */
		
		//$contentHandler->update( '<node></noded>' );
	}
	
	public function testSearch()
	{
		$result = $this->contentHandler->search( '//node[@id="1"]' );
		$this->assertEquals( $result->length, 1 );
		
		// Test permissions
		//$result = $this->contentHandler->search( '//node[@id="2"]' );
		//$this->assertEquals( $result->length, 0 );
	}
}

?>