<?php 

namespace BaseXMSInspect\UiComponent;

use BaseXMS\DataObjectHandler\ContentObject;
use BaseXMS\UiComposer\UiComposer;
use BaseXMS\UiComposer\UiComponent\HtmlWidget;

class Content extends HtmlWidget
{
	protected function getXml()
	{
		$contextNodeId = $this->uiComposer->getContextData()->queryToValue( '//dispatchResult/id' );
		
		$contentObjectHandler = new ContentObject();
		$contentObjectHandler->setServiceLocator( $this->getUiComposer()->getServiceLocator() );
		$contentObject = $contentObjectHandler->read( $contextNodeId, 'xml' );

		// cache object
		$refId = $this->referenceObject( $contentObject );
		
		//TODO: isn't there a way to query to an attribute values?
		$contentElement = $contentObject->query( '//content' )->item(0);
		$class = $contentElement->getAttribute( 'class' );
		
		return '
<div class="content">

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="#">Inspect</a>
          <div class="nav-collapse collapse">
            <p class="navbar-text pull-right">
              Logged in as <a href="#" class="navbar-link">Username</a>
            </p>
            <ul class="nav">
              <li class="active"><a href="#">Home</a></li>
              <li><a href="#about">About</a></li>
              <li><a href="#contact">Contact</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    
    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span3">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">Sidebar</li>
              <li class="active"><a href="#">Link</a></li>
              <li><a href="#">Link</a></li>
              <li><a href="#">Link</a></li>
              <li><a href="#">Link</a></li>
              <li class="nav-header">Sidebar</li>
              <li><a href="#">Link</a></li>
              <li><a href="#">Link</a></li>
              <li><a href="#">Link</a></li>
              <li><a href="#">Link</a></li>
              <li><a href="#">Link</a></li>
              <li><a href="#">Link</a></li>
              <li class="nav-header">Sidebar</li>
              <li><a href="#">Link</a></li>
              <li><a href="#">Link</a></li>
              <li><a href="#">Link</a></li>
            </ul>
          </div>
        </div>
        <div class="span9">
          <include type="full" refid="'. $refId .'" class="'. $class .'" />
          <include type="children" />
        </div>
      
      <hr />
    </div>
      
    <footer>
      <p>Copyright Company 2013</p>
    </footer>

	</div>
</div>';
	}
}

?>