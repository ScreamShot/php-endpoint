<?php

require_once('config.php');

function isAnimatedGif($filename) {
    return (bool)preg_match('#(\x00\x21\xF9\x04.{4}\x00\x2C.*){2,}#s', file_get_contents($filename));
}

function send_image($path, $is_image = false, $mime = ''){
	header('Content-Description: File Transfer');
	header('Content-Type: ' . $mime);
	header('Content-Disposition: ' . ($is_image?'inline':'attachement') . '; filename='.basename($path));
	header('Content-Length: ' . filesize($path));
	readfile($path);
	exit;
}

$filename = BASE_PATH . pathinfo(parse_url($_SERVER['REQUEST_URI'])['path'])['basename'];

$files = array($filename);

if(!file_exists($filename)){
	$files = glob($filename . '.*');
	if(empty($files)){
		header('HTTP/1.0 404 Not Found', true, 404);
		die('404.');
	}
}

$f = $files[0];
$finfo = finfo_open(FILEINFO_MIME_TYPE); // Retourne le type mime à la extension mimetype
$mime = finfo_file($finfo, $f);
finfo_close($finfo);
$is_image = substr($mime, 0, 6) == 'image/';

$ua = '';
if(array_key_exists('HTTP_USER_AGENT', $_SERVER))
	$ua = $_SERVER['HTTP_USER_AGENT'];

if (stripos($ua, 'bot') === false || basename($filename) == basename($f)) {
	send_image($f, $is_image, $mime);
}

// Twitter integration
header('Vary: User-Agent');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<?php if($is_image): ?>
		<?php if(isAnimatedGif($f)): ?>
			<?php list($width, $height) = getimagesize($f); ?>
		<meta name="twitter:card" content="player" />
		<meta name="twitter:player:width" content="<?php echo $width; ?>">
		<meta name="twitter:player:height" content="<?php echo $height; ?>">
		<meta name="twitter:player:title" content="Image">
		<meta name="twitter:player" content="<?php echo BASE_URL . basename($f); ?>" />
		<? else: ?>
		<meta name="twitter:card" content="photo" />
		<meta name="twitter:image" content="<?php echo BASE_URL . basename($f); ?>" />
		<?php endif; ?>
	<?php endif; ?>
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
