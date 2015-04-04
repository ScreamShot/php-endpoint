<?php

// Let's log errors in a file, just in case!
ini_set('error_log','errors.log');

// Base path for image link, including the trailing /
// Used to give the link to ScreamShot and for Twitter integration
define('BASE_URL', 'https://j.ungeek.fr/');

// __DIR__ = directory containing this config.php file
// DIRECTORY_SEPARATOR is used to be compatible with Windows and *nix
// Here, we upload files to the 'uploads' directory
define('BASE_PATH', __DIR__ . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR);