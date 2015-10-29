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

// Your twitter name
// Used to link images to your twitter account
define('TWITTER_ACCOUNT', 'PunKeel');

// The message you want displayed under your images
define('TWITTER_TITLE', 'Yo!');

// Your main website url, displayed under the image
define('TWITTER_URL', 'https://ungeek.fr/');