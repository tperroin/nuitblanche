<?php
/*
 * This file is part of the SC2Ranks package.
 *
 * (c) Antoine Berranger <antoine@ihqs.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SC2Ranks\Api;

use SC2Ranks\Client\ClientInterface;

/**
 *
 *
 * @version	0.1
 * @author	Antoine Berranger <antoine@ihqs.net>
 */
abstract class BaseApi
{
	const REGION_ALL = "all";
	const REGION_CN = "cn";
	const REGION_EU = "eu";
	const REGION_KR = "kr";
	const REGION_LA = "la";
	const REGION_RU = "ru";
	const REGION_SEA = "sea";
	const REGION_TW = "tw";
	const REGION_US = "us";

	static protected $regions = array(
		self::REGION_CN,
		self::REGION_EU,
		self::REGION_KR,
		self::REGION_LA,
		self::REGION_RU,
		self::REGION_SEA,
		self::REGION_TW,
		self::REGION_US,
	);

	protected $client;
	protected $hydratationClass;

	public function __construct(ClientInterface $client)
	{
		$this->setClient($client);
		$this->init();
	}

	abstract protected function init();

	public function setClient(ClientInterface $client)
	{
		$this->client = $client;
		return $this;
	}

	public function getClient()
	{
		return $this->client;
	}

	public function getHydratationClass()
	{
		return $this->hydratationClass;
	}

	public function setHydratationClass($hydratationClass)
	{
		$this->hydratationClass = $hydratationClass;
	}
	
	public function getType()
	{
		$class = explode('\\', get_class($this));
		$type  = strtolower(array_pop($class));
		return $type;
	}

	public function request($parameters)
	{
		$response = $this->getClient()->request($parameters);

		if($this->hydratationClass)
		{
			$class = $this->hydratationClass;
			$object = new $class($response);
			return $object;
		}

		return json_decode($response);
	}
}