<?php 

$projectName	= 'uploadProject';
$email			= 'neil@wolfiezero.com';

if ($_SEVER['REMOTE_ADDR'] === '207.97.227.253') {
	mail($email, '['.$projectName.'] `GIT PULL` successful', 'Request came form '.$_SERVER['REMOTE_ADDR']);
	`git pull`;
} else {
	mail($email, '['.$projectName.'] `GIT PULL` failed', 'Request came form '.$_SERVER['REMOTE_ADDR']);
}