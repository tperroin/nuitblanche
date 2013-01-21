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
class File extends AbstractClient
{
	public function initHandler()
	{
		$this->handler = "empty";
	}

	protected function doRequest($request_url)
	{
		return file_get_contents($request_url);
	}
}