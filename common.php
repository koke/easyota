<?php

require 'CFPropertyList/CFPropertyList.php';

function get_plist($id) {
  $zip = zip_open("apps/$id.ipa");
  while(($zip_entry = zip_read($zip)) !== false){ 
    if (preg_match("/\.app\/Info.plist$/", zip_entry_name($zip_entry))) {
      $tmpfname = tempnam("/tmp", "FOO");

      file_put_contents($tmpfname, zip_entry_read($zip_entry, zip_entry_filesize($zip_entry)));
      $plist = new CFPropertyList( $tmpfname );
    }
  }
  zip_close($zip);
  return $plist->toArray();
}

function is_ssl() {
  if ( isset($_SERVER['HTTPS']) ) {
    if ( 'on' == strtolower($_SERVER['HTTPS']) )
      return true;
    if ( '1' == $_SERVER['HTTPS'] )
      return true;
  } elseif ( isset($_SERVER['SERVER_PORT']) && ( '443' == $_SERVER['SERVER_PORT'] ) ) {
    return true;
  }
  return false;
}

function base_url() {
  $schema = is_ssl() ? 'https://' : 'http://';
  $url =  $schema . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
  return dirname(rtrim($url, '/'));
}

?>
