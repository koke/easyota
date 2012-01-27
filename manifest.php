<?php

$id = preg_replace( '/[^A-Za-z0-9]/', '', $_SERVER["PATH_INFO"]);
require 'common.php';
$plist = get_plist( $id );
echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<!DOCTYPE plist PUBLIC "-//Apple//DTD PLIST 1.0//EN" "http://www.apple.com/DTDs/PropertyList-1.0.dtd">
<plist version="1.0">
<dict>
	<key>items</key>
	<array>
		<dict>
			<key>assets</key>
			<array>
				<dict>
					<key>kind</key>
					<string>software-package</string>
					<key>url</key>
					<string><?php echo base_url(); ?>/apps/<?php echo $id; ?>.ipa</string>
				</dict>
			</array>
			<key>metadata</key>
			<dict>
				<key>bundle-identifier</key>
				<string><?php echo $plist["CFBundleIdentifier"]; ?></string>
				<key>bundle-version</key>
				<string><?php echo $plist["CFBundleVersion"]; ?></string>
				<key>kind</key>
				<string>software</string>
				<key>title</key>
				<string><?php echo $plist["CFBundleName"]; ?></string>
			</dict>
		</dict>
	</array>
</dict>
</plist>
