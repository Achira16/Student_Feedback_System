<?php
//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('758229098056-vuedngtbcb0ub0euce6j6kv31i8ta0h4.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('r_7bw1YX6mYaEio-Ttbop8vQ');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('http://localhost/stud_feed_sys/index.php');

// to get the email and profile 
$google_client->addScope('email');

$google_client->addScope('profile');

?> 