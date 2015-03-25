<?php
/**
 * @namespace
 */
namespace BaseXMSInspect\Log;

use Zend\Log\Filter\FilterInterface;

class Filter implements FilterInterface
{
	public function filter( array $event )
	{
		return $event[ 'priority' ] < 6;
	}
}
