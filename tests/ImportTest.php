<?php

use BaseXMS\Stdlib\DOMDocument;

use BaseXMS\DataObjectHandler\Import;

include_once( 'BaseXMSTest.php' );

class ImportTest extends BaseXMSTest
{
	public function setUp()
	{
		parent::setUp();
		
		// Adding node
		$this->importHandler = new Import();
		$this->importHandler->setServiceLocator( $this->services );
	}
	
	public function testImportHandler()
	{
		// No valid $doc provided - not yet supported - everything is important (valid and invalid)
		#$xml = '<invalid></invalid>';
		#$doc = new DOMDocument();
		#$doc->loadXML( $xml );
		
		#$result = $this->importHandler->importNodeTree( $doc, 1 );
		#$this->assertFalse( $result );
		
		
		// valid xml doc
		$nodeTreeXML =
<<<XML
	<node id='101'>
		<accessPaths class='\BaseXMSRest\RequestHandler\Rest'>
			<entry type='main' path='REST' />
		</accessPaths>
	
		<content class=''>
			<sort>REST</sort>
		</content>
		
		<node id='102'>
			<accessPaths class='\BaseXMSRest\RequestHandler\Rest'>
				<entry type='main' path='node' />
			</accessPaths>

			<content class=''></content>
			
			<node id='103'>
				<accessPaths class='\BaseXMSRest\RequestHandler\Rest'>
					<entry type='main' path='create' />
				</accessPaths>
				
				<content class=''></content>
			</node>
		</node>
	</node>
XML;

		$doc = new DOMDocument();
		$doc->loadXML( $nodeTreeXML );
		
		// importNodeTree with invalid parentNodeId
		$result = $this->importHandler->importNodeTree( $doc, '-1' );
		$this->assertFalse( $result );
		
		// import node tree
		$result = $this->importHandler->importNodeTree( $doc, '1' );
		$this->assertTrue( $result );
		
	}
}

?>