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

/**
 * 
 *
 * @version	0.1
 * @author	Antoine Berranger <antoine@ihqs.net>
 */
class Division extends BaseApi
{
	const LEVEL_ALL			= "all";
	const LEVEL_GRANDMASTER = "grandmaster";
	const LEVEL_MASTER		= "master";
	const LEVEL_DIAMOND		= "diamond";
	const LEVEL_PLATINUM	= "platinum";
	const LEVEL_GOLD		= "gold";
	const LEVEL_SILVER		= "silver";
	const LEVEL_BRONZE		= "bronze";

	static public $levels = array(
		self::LEVEL_BRONZE,
		self::LEVEL_SILVER,
		self::LEVEL_GOLD,
		self::LEVEL_PLATINUM,
		self::LEVEL_DIAMOND,
		self::LEVEL_MASTER,
		self::LEVEL_GRANDMASTER,
	);

	protected function init()
	{
		self::$levels[]		= self::LEVEL_ALL;
		self::$regions[]	= self::REGION_ALL;
	}

	public function divList($div_id, $level, $bracket, $region = "eu", $random = false)
	{
		if(!in_array($region, self::$regions))
		{
			throw new \InvalidArgumentException("Unknown region '" . $region . "'.");
		}
		
		if(!in_array($level, self::$levels))
		{
			throw new \InvalidArgumentException("Unknown league level '" . $level . "'.");
		}

		return $this->request('clist/' . $div_id . '/' . $region . '/' . $level . '/' . $bracket . '/' . ($random ? 1 : 0));
	}

	public function addToCustom($custom_id, $password, array $chars = array())
	{
		$this->managerCustom($custom_id, $password, 'add', $chars);
	}

	public function removeFromCustom($custom_id, $password, array $chars = array())
	{
		$this->managerCustom($custom_id, $password, 'remove', $chars);
	}
	
	protected function manageCustom($custom_id, $password, $mode, array $chars = array())
	{
		return $this->request('custom/' . $custom_id . '/' . $password . '/' . $mode . '/' . implode(',', $chars));
	}
}