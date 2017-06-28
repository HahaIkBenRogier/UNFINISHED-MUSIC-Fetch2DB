<?php
	$session = new SpotifyWebAPI\Session(
		'c74caa56431d423ebb87f06203a1f02d',
		'9ad75d507ab34ee4b1df302243c444fa',
		'http://localhost:8888/Musicscreen/readIDs.php'
	);

	$api = new SpotifyWebAPI\SpotifyWebAPI();

	$session->requestCredentialsToken();
	$accessToken = $session->getAccessToken();

	// Set the code on the API wrapper
	$api->setAccessToken($accessToken);

	// The API can now be used!

?>