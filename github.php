<?php 
require('logger.php');

$log = new Logger();

$log->logVar($_SERVER, 'SERVER_CALL');

`git pull`;