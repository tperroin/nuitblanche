<?php
/*
 * This file is part of the SC2Ranks package.
 *
 * (c) Antoine Berranger <antoine@ihqs.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SC2Ranks\Client;

/**
 * Client Interface
 *
 * @version	0.1
 * @author	Antoine Berranger <antoine@ihqs.net>
 */
abstract class AbstractClient implements ClientInterface
{
	const BASE_URL = "http://sc2ranks.com/api";

	protected static $requests;

	protected $handler;
	protected $clientKey;

	public function __construct($clientKey)
	{
		$this->clientKey = $clientKey;
		$this->initHandler();
	}

	public function request($parameters)
	{
		$request_url = self::BASE_URL
			. '/' . $parameters
			. '.json?appKey=' . rawurlencode($this->clientKey)
		;

		if(!isset(self::$requests[$request_url]))
		{
			if(!isset($this->handler))
			{
				throw new \RuntimeException("You got to set Client handler before calling any request");
			}

			$result = $this->doRequest($request_url);

			self::$requests[$request_url] = $result;
		}

		return self::$requests[$request_url];
	}

	abstract protected function initHandler();
	abstract protected function doRequest($request_url);
}