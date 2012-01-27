<?php

if ( array_key_exists( "ipa", $_FILES ) ) {
  if ( $_FILES["ipa"]["size"] > 20 * 1024 * 1024 ) {
    $error = "The file is larger than 20M";
  } else {
    $dest = tempnam( dirname(__FILE__) . '/apps', '' );
    $name = basename($dest);
    move_uploaded_file( $_FILES["ipa"]["tmp_name"], "$dest.ipa" );
    header( "Location: /$name" );
    die();
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
  <head>
    <title>OTA installation for iOS apps</title>
    <style type="text/css" media="screen">
      body { background: #eee;}
      #main { margin: 10px auto; padding: 10px 20px; width: 640px; background: #fff; border: 1px solid #ddd; border-radius: 20px;}
    </style>
  </head>
  <body>
    <div id="main">
    <?php if ( isset( $error ) ):
        echo $error;
    else: ?>
      <h1>Share your app</h1>
      <p>Upload an IPA file (up to 20 MB) and let us do the rest</p>
      <form enctype="multipart/form-data" action="" method="post" accept-charset="utf-8">
        <input type="file" name="ipa" id="ipa">

        <p><input type="submit" value="Upload"></p>
      </form>
    <?php endif; ?>
  </div>
  </body>
</html>
