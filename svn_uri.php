<?php
$xml = simplexml_load_file("megamanifest.xml");
$xquery = "/pkgs/package[@name='{$_GET['pkg']}']";
$pkg = $xml->xpath($xquery);
$pkg = $pkg[0];
if ($pkg)
  echo $pkg['repo'] . $pkg['path'];
?>
