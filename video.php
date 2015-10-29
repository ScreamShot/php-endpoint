<?php if(!defined('BASE_URL')) die(); ?>
<!DOCTYPE html>
<html>
  <head>
    <title><?php echo TWITTER_TITLE; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="/layout.css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <link href="http://vjs.zencdn.net/5.0.2/video-js.css" rel="stylesheet">
	<!-- If you'd like to support IE8 -->
	<script src="http://vjs.zencdn.net/ie8/1.1.0/videojs-ie8.min.js"></script>
	<script src="http://vjs.zencdn.net/5.0.2/video.js"></script>
  </head>
  <body >
<header>
	  <a target="_blank" href="https://github.com/ScreamShot/ScreamShot">ScreamShot</a>
</header>

<div class="container">
  <video width="auto" height="auto" class="video-js vjs-default-skin"
    controls autoplay preload loop
    data-setup='{ "autoplay": true, "preload": "auto" }'>
	    <source src="<?php echo BASE_URL . basename($f); ?>" type="<?php echo $mime; ?>">
	    <p class="vjs-no-js">
      To view this video please enable JavaScript, and consider upgrading to a web browser that
      <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
    </p>
  </video>
</div>
  </body>
</html>
