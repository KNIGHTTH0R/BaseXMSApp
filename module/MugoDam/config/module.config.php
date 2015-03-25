<?php
return array(
		'siteaccesses' => array(
				'dam'     => '\MugoDam\Mvc\SiteAccess',
				'damrest' => '\MugoDam\Mvc\RestSiteAccess'
		),
		
		'designrules' => array(
				'mugodam' => array(
						'/context/type[text()  = "content"]'  => '\MugoDam\UiComponent\Content',
						'/context/class[text() = "image"]'    => '\MugoDam\UiComponent\FullImage',
						'/context/type[text() = "full"]'    => '\MugoDam\UiComponent\Full',
				)
		)
);
