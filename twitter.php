<?php if(!defined('BASE_URL')) die(); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<?php if($is_image): ?>
		<?php list($width, $height) = getimagesize($f); ?>
		<meta name="twitter:card" content="photo" />
		<meta property="og:image" content="<?php echo BASE_URL . basename($f); ?>" />
		<meta name="twitter:image" content="<?php echo BASE_URL . basename($f); ?>" />
		<meta name="twitter:image:width" content="<?php echo $width; ?>">
		<meta name="twitter:image:height" content="<?php echo $height; ?>">
	<?php endif; ?>
	<?php if(defined('TWITTER_ACCOUNT')): ?>
		<meta name="twitter:site" content="@<?php echo TWITTER_ACCOUNT; ?>" />
	<?php endif; ?>
	<?php if(defined('TWITTER_TITLE')): ?>
		<meta property="og:title" content="<?php echo TWITTER_TITLE; ?>" />
	<?php endif; ?>
	<?php if(defined('TWITTER_URL')): ?>
		<meta property="og:url" content="<?php echo TWITTER_URL; ?>" />
	<?php endif; ?>
	</head>
	<body>
		Hello, World.
	</body>
</html>