<?php 
require('logger.php');

$log = new logger();

$log->logVar($_SERVER, 'SERVER_CALL');

`git pull`;