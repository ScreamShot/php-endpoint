<?php

require_once('config.php');

function curPageURL() {
	$pageURL = 'https';
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80")
		$pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"]. '/_' . $_SERVER["REQUEST_URI"];
	else
		$pageURL .= $_SERVER["SERVER_NAME"] . '/_' . $_SERVER["REQUEST_URI"];
	return $pageURL;
}

function isAnimatedGif($filename) {
    return (bool)preg_match('#(\x00\x21\xF9\x04.{4}\x00\x2C.*){2,}#s', file_get_contents($filename));
}

$filename = pathinfo(parse_url($_SERVER['REQUEST_URI'])['path'])['filename'];
$files = glob(BASE_PATH . $filename . '.*');
if(empty($files)){
	header('HTTP/1.0 404 Not Found', true, 404);
	die('404.');
}

$f = $files[0];
$finfo = finfo_open(FILEINFO_MIME_TYPE); // Retourne le type mime à la extension mimetype
$mime = finfo_file($finfo, $f);
finfo_close($finfo);
$is_image = substr($mime, 0, 6) == 'image/';
if (stripos($_SERVER['HTTP_USER_AGENT'], 'Twitterbot') !== false) {
	header('Vary: User-Agent');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<?php if($is_image){ ?>
	<?php if(isAnimatedGif($f)){ ?>
		<?php list($width, $height) = getimagesize($f); ?>
		<meta name="twitter:card" content="player" />
		<meta name="twitter:player:width" content="<?php echo $width; ?>">
		<meta name="twitter:player:height" content="<?php echo $height; ?>">
		<meta name="twitter:player:title" content="Image">
		<meta name="twitter:player" content="<?php echo BASE_URL . $f; ?>" />
	<? }else{ ?>
		<meta name="twitter:card" content="photo" />
		<meta name="twitter:image" content="<?php echo BASE_URL . $f; ?>" />
	<?php } ?>
	<?php	} ?>
	<?php if(defined('TWITTER_ACCOUNT')): ?>
		<meta name="twitter:site" content="@<?php echo TWITTER_ACCOUNT; ?>" />
	<?php endif; ?>
	<?php if(defined('TWITTER_TITLE')): ?>
		<meta name="twitter:title" content="<?php echo TWITTER_TITLE; ?>" />
	<?php endif; ?>
	<?php if(defined('TWITTER_URL')): ?>
		<meta name="twitter:url" content="<?php echo TWITTER_URL; ?>" />
	<?php endif; ?>
	</head>
	<body>
		Hello, World.
	</body>
</html>
<?php
	exit;
}

header('Content-Description: File Transfer');
header('Content-Type: ' . $mime);
header('Content-Disposition: ' . ($is_image?'inline':'attachement') . '; filename='.basename($f));
header('Content-Length: ' . filesize($f));
readfile($f);