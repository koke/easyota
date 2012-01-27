<?php
$id = preg_replace( '/[^A-Za-z0-9]/', '', $_GET["id"]);
if ( strlen( $id ) == 0 || ! file_exists( "apps/$id.ipa" ) ) {
  header( 'HTTP/1.0 404 Not Found' );
  die();
}
require 'common.php';
$plist = get_plist( $id );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
  <head>
    <title>OTA installation for iOS apps</title>
    <style type="text/css" media="screen">
      body { background: #eee; font-family: Helvetica}
      #main { margin: 10px auto; padding: 10px 20px; width: 640px; background: #fff; border: 1px solid #ddd; border-radius: 20px; text-align: center;}
    </style>
    <meta name="viewport" content="width=device-width" />
  </head>
  <body>
    <div id="main">
    <h1><?php echo $plist['CFBundleName'] . ' ' . $plist['CFBundleVersion']; ?></h1>
    <div class="link">
      <a href="itms-services://?action=download-manifest&url=<?php echo base_url(); ?>/manifest.php/<?php echo $id; ?>"><img src="down.png"></a>
    </div>
    <div class="download">
      <a href="/apps/<?php echo $id; ?>.ipa">Get the IPA file</a>
    </div>
    <div id="qr">
      <img src="https://chart.googleapis.com/chart?chs=450x450&cht=qr&chl=<?php echo urlencode( base_url() . "/$id" ); ?>" />
    </div>
  </div>
  </body>
</html>
