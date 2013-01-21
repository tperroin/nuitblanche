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
class Player extends BaseApi
{
	const SEARCH_TYPE_CONTAINS	= "contains";
	const SEARCH_TYPE_ENDS		= "ends";
	const SEARCH_TYPE_EXACT		= "exact";
	const SEARCH_TYPE_STARTS	= "starts";

	static private $search_types = array(
		self::SEARCH_TYPE_CONTAINS,
		self::SEARCH_TYPE_ENDS,
		self::SEARCH_TYPE_EXACT,
		self::SEARCH_TYPE_STARTS,
	);

	const PROFILE_SEARCH_TYPE_1v1 = "1t";
	const PROFILE_SEARCH_TYPE_2v2 = "2t";
	const PROFILE_SEARCH_TYPE_3v3 = "3t";
	const PROFILE_SEARCH_TYPE_4v4 = "4t";
	const PROFILE_SEARCH_TYPE_ACHIEVE = "achieve";

	static private $profile_search_types = array(
		self::PROFILE_SEARCH_TYPE_1v1,
		self::PROFILE_SEARCH_TYPE_2v2,
		self::PROFILE_SEARCH_TYPE_3v3,
		self::PROFILE_SEARCH_TYPE_4v4,
		self::PROFILE_SEARCH_TYPE_ACHIEVE,
	);

	const PROFILE_SEARCH_SUBTYPE_POINTS		= "points";
	const PROFILE_SEARCH_SUBTYPE_WINS		= "wins";
	const PROFILE_SEARCH_SUBTYPE_LOSSES		= "losses";
	const PROFILE_SEARCH_SUBTYPE_DIVISION	= "division";

	static private $profile_search_subtypes = array(
		self::PROFILE_SEARCH_SUBTYPE_POINTS,
		self::PROFILE_SEARCH_SUBTYPE_WINS,
		self::PROFILE_SEARCH_SUBTYPE_LOSSES,
		self::PROFILE_SEARCH_SUBTYPE_DIVISION,
	);
	
	protected $account;

	protected function init()
	{
		;
	}

	public function setAccount($name, $code, $region = "eu")
	{
		if(!in_array($region, self::$regions))
		{
			throw new \InvalidArgumentException("Unknown region '" . $region . "'.");
		}

		$this->account =  $region . '/' . $name . '$' . $code;
		return $this;
	}

	public function setAccountById($name, $id, $region = "eu")
	{
		if(!in_array($region, self::$regions))
		{
			throw new \InvalidArgumentException("Unknown region '" . $region . "'.");
		}

		$this->account =  $region . '/' . $name . '!' . $id;
		return $this;
	}

	public function getAccount()
	{
		return $this->account;
	}

	public function baseChar()
	{
		return $this->request('base/char/' . $this->account);
	}

	public function baseTeams()
	{
		return $this->request('base/teams/' . $this->account);
	}

	public function charTeams($bracket, $random = false)
	{
		return $this->request('char/teams/' . $this->account . '/' . $bracket . '/' . ($random ? 1 : 0));
	}

	public function search($name, $search = self::SEARCH_TYPE_EXACT, $region = "eu", $offset = false)
	{
		if(!in_array($search, self::$search_types))
		{
			throw new \InvalidArgumentException("Wrong search type '" . $search . "'.");
		}
		
		if(!in_array($region, self::$regions))
		{
			throw new \InvalidArgumentException("Unknown region '" . $region . "'.");
		}

		$url = $search . 'search/' . $region . '/' . $name;
		if($offset) { $url .= '/' . $offset; }
		return $this->request($url);
	}

	public function profileSearch($name, $type, $subtype, $value, $region = "eu")
	{
		if(!in_array($type, self::$profile_search_types))
		{
			throw new \InvalidArgumentException("Wrong profile search type '" . $type . "'.");
		}

		if(!in_array($subtype, self::$profile_search_subtypes))
		{
			throw new \InvalidArgumentException("Wrong profile search subtype '" . $subtype . "'.");
		}

		return $this->request('psearch/' . $region . '/' . $name . '/' . $type . '/' . $subtype . '/' . $value);
	}
}