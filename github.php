<?php 

$projectName	= 'uploadProject';
$email			= 'neil@wolfiezero.com';
$remoteIP		= $_SERVER['REMOTE_ADDR'];
$msg			= 'Request came form '.$remoteIP.' - http://whois.arin.net/rest/ip/'.$remoteIP;
$password		= '6c78fe881a86738ef8e660a9705cdd5a'; // == th2sc4d
$salt			= 'th1s54l7y';

if (isset($_GET['check'])) {

	$check = md5(crypt($_GET['check'], $salt));

	if ($password === $check) {
		mail($email, '['.$projectName.'] `GIT PULL` successful', $msg);
		`git pull`;
	} else {
		mail($email, '['.$projectName.'] `GIT PULL` failed', $msg);
	}
} else {
	mail($email, '['.$projectName.'] `GIT PULL` failed', $msg);
}