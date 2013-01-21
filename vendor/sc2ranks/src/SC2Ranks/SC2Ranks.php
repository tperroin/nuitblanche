<?php
/*
 * This file is part of the SC2Ranks package.
 *
 * (c) Antoine Berranger <antoine@ihqs.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SC2Ranks;

/**
 * SC2Ranks API boostraper
 *
 * @version	0.1
 * @author	Antoine Berranger <antoine@ihqs.net>
 */
class SC2Ranks
{
	protected $apis = array();
	protected $client;

	public function __construct($clientKey, $clientClass = '\SC2Ranks\Client\File')
	{
		$this->client = new $clientClass($clientKey);

		$this->addApi('SC2Ranks\Api\Division');
		$this->addApi('SC2Ranks\Api\Map');
		$this->addApi('SC2Ranks\Api\Player');
		$this->addApi('SC2Ranks\Api\Pool');
	}

	public function addApi($class)
	{
		if(!class_exists($class))
		{
			throw new \InvalidArgumentException("Unknown api class : '" . $class . "'");
		}

		$api = new $class($this->client);

		if(isset($this->apis[$api->getType()]))
		{
			throw new \InvalidArgumentException("Api class '" . $class . "' is already loaded");
		}

		$this->apis[$api->getType()] = $api;
	}

	public function removeApi($name)
	{
		if(!isset($this->apis[$name]))
		{
			throw new \InvalidArgumentException("Api class '" . $class . "' is not loaded");
		}

		unset($this->apis[$name]);
	}

	public function getApi($name)
	{
		if(!isset($this->apis[$name]))
		{
			throw new \InvalidArgumentException("Unknown api type : '" . $name . "'");
		}

		return $this->apis[$name];
	}
}