<?php
return array(
		'siteaccesses' => array(
				'inspect'  => '\BaseXMSInspect\SiteAccess'
		),
		
		'designs' => array(
				0 => 'inspect',
		),

		'designrules' => array(
				'inspect' => array(
						'/context/type[text() = "content"]'  => '\BaseXMSInspect\UiComponent\Content',
						'/context/type[text() = "full"]'     => '\BaseXMSInspect\UiComponent\Full',
						'/context/type[text() = "children"]' => '\BaseXMSInspect\UiComponent\Children',
						'/context/type[text() = "row"]'      => '\BaseXMSInspect\UiComponent\Row',
						'/context/type[text() = "nodeName"]' => '\BaseXMSInspect\UiComponent\NodeName',
						'/context/type[text() = "html"]'     => '\BaseXMSInspect\UiComponent\Html',
				)
		)
);
