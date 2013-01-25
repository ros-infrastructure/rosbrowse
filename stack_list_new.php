<?php
$title = "ROS stacks";
include "rosbrowse_new.inc";
$pkgs = array();
$distro = 'fuerte';
if (isset($_GET['distro']) && !empty($_GET['distro']))
{
  $distro = $_GET['distro'];
}
$dir_path = "../doc/" . $distro . "/api";
if ($handle = opendir($dir_path))
{
  while(false !== ($entry = readdir($handle)))
  {
    $filename = $dir_path . "/" . $entry . "/manifest.yaml";
    if(is_file($filename))
    {
      //only take the relevant pieces of the yaml to save on memory
      $yaml = yaml_parse(file_get_contents($filename));
      if($yaml['package_type'] == 'stack' || $yaml['package_type'] == 'metapackage')
      {
        $pkgs[$entry] = array();
        $pkgs[$entry]['brief'] = $yaml['brief'];
        $pkgs[$entry]['description'] = $yaml['description'];
      }
    }
  }
  closedir($handle);
}

?>
<div id="dpage">
  <div id="dpage-inner">
<table>
<tr><th>Name</th><th width="100%">Description</th></tr>
<?php
ksort($pkgs);
foreach($pkgs as $name => $pkg)
{
  $desc = (string)$pkg['brief'];
  if (strlen($desc) < 10)
  {
    $desc = (string)$pkg['description'];
    $desc = substr($desc, 0, 100);
    if (strlen($desc) == 100)
      $desc .= "...";
  }
  echo "<tr><td class='pkgname'>";
  echo "<a href=\"details_new.php?distro=" . urlencode($distro) . "&name=" . urlencode($name) . "\">" . $name . "</a>";
  echo "</td><td>" . htmlentities($desc) . "</td></tr>\n";
}
?>
</table>
</div>
</div>

</body>
</html>

