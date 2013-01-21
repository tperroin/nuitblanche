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
 *
 *
 * @version	0.1
 * @author	Antoine Berranger <antoine@ihqs.net>
 */
class Curl extends AbstractClient
{
	public function initHandler()
	{
		$handler = curl_init();
		curl_setopt($handler, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($handler, CURLOPT_HEADER, 0);
		curl_setopt($handler, CURLOPT_CONNECTTIMEOUT, 5);

		$this->handler = $handler;
	}

	protected function doRequest($request_url)
	{
		curl_setopt($this->handler, CURLOPT_URL, $request_url);
		return curl_exec($this->handler);
	}

	public function __destruct()
	{
		curl_close($this->handler);
	}
}