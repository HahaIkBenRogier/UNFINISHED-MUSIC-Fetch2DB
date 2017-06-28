<?php
use LastFmApi\Api\AuthApi;
use LastFmApi\Api\UserApi;
use LastFmApi\Api\ArtistApi;

class LastFm
{
	private $apiKey;
	private $artistApi;
	private $userApi;

	public function __construct()
	{
		$this->apiKey = '317a3ad623b2a63c8b648550755991e2'; //required
		$this->apiSecret = '4a9c1e8ebadcf3a1eaeaba665fb61289';
		$auth = new AuthApi('setsession', array('apiKey' => $this->apiKey));
		$this->artistApi = new ArtistApi($auth);
		$this->userApi = new UserApi($auth);
	}
	public function getBio($artist)
	{
		$artistInfo = $this->artistApi->getInfo(array("artist" => $artist));

		return $artistInfo['bio'];
	}
	
	public function getPlaycount($user)
	{
		$info = $this->userApi->getInfo(array("user"=>$user));
		return $info['playcount'];
	}
	
	public function getTracks($user, $page, $to)
	{
		$recenttracks = $this->userApi->getRecentTracks(array("user" => $user, "page" => $page, "to" => $to));
		return $recenttracks;
	}	
}

?>