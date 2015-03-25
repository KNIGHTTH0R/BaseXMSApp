<?php

use BaseXMS\DataObjectHandler\Node;

include_once( 'BaseXMSTest.php' );

class NodeTest extends BaseXMSTest
{
	public function setUp()
	{
		parent::setUp();
		
		// Adding node
		$this->nodeHandler = new Node();
		$this->nodeHandler->setServiceLocator( $this->services );
	}
	
	public function testNodeHandler()
	{
		// CreateNode with minmum XML - remember ID for delete test
		$nodeXml =
<<<XML
<node>
	<accessPaths></accessPaths>
	<content></content>
</node>
XML;
		$doc = new DomDocument();
		$doc->loadXML( $nodeXml );
		
		$newId = $this->nodeHandler->create( 1, $doc );
		$this->assertTrue( strlen( $newId ) > 0 );

		// CreateNode with minmum XML and given id
		$nodeXml =
		<<<XML
<node id="123">
	<accessPaths></accessPaths>
	<content></content>
</node>
XML;
		$doc = new DomDocument();
		$doc->loadXML( $nodeXml );
		
		$id = $this->nodeHandler->create( 1, $doc );
		$this->assertTrue( strlen( $id ) > 0 );

		// CreateNode complex node
		$nodeXml =
		<<<XML
<node id="123">
	<accessPaths>
		<entry type="" path=""></entry>
	</accessPaths>
	<content>
		<raw>
			asdf<d></d>
		</raw>
	</content>
</node>
XML;
		$doc = new DomDocument();
		$doc->loadXML( $nodeXml );
		
		$id = $this->nodeHandler->create( 1, $doc );
		$this->assertTrue( strlen( $id ) > 0 );
		
		//Delete a node
		$result = $this->nodeHandler->delete( $newId );
		$this->assertTrue( $result );
	}
	
	public function testMissingParentIdException()
	{
		try
		{
			$this->nodeHandler->create( '', null );
		}
		catch( Exception $expected )
		{
			return;
		}
		
		$this->fail( 'An expected exception has not been raised.' );
	}

	public function testInvalidParentIdException()
	{
		try
		{
			$this->nodeHandler->create( -1, null );
		}
		catch( Exception $expected )
		{
			return;
		}
	
		$this->fail( 'An expected exception has not been raised.' );
	}
	
	public function testInvalidAttribueOnNodeTag()
	{
		try
		{
			// CreateNode with minmum XML and wrong attribute on node
			$nodeXml =
			<<<XML
<node id="123" invalid="true">
	<accessPaths></accessPaths>
	<content></content>
</node>
XML;
			$doc = new DomDocument();
			$doc->loadXML( $nodeXml );
			
			$id = $this->nodeHandler->create( 1, $doc );
		}
		catch( Exception $e )
		{
			return;
		}
		
		$this->fail( 'An expected exception has not been raised.' );
	}
}

?>