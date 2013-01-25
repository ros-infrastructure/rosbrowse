<?php
$title = $_GET['name'];
include "rosbrowse.inc";
$all_pkgs = yaml_parse(file_get_contents('megamanifest.yaml'));
$pkgs = array();
foreach ($all_pkgs as $p)
{
  if ($p['repo'] == $_GET['repo_host'])
  {
    array_push($pkgs, $p);
  }
}
?>
<div id="dpage">
  <div id="dpage-inner">

  <h2>Packages provided by <?php echo $_GET['repo_host']; ?></h1>
<table>
<tr><th>Name</th><th>Description</th></tr>
<?php
function alpha_cb($a, $b)
{
  return strcmp(strtoupper($a['name']), strtoupper($b['name']));
}
usort($pkgs, "alpha_cb");
foreach($pkgs as $pkg)
{
  $name = (string)$pkg['name'];
  $desc = (string)$pkg['brief'];
  if (strlen($desc) < 10)
  {
    $desc = (string)$pkg['description'];
    $desc = substr($desc, 0, 100);
    if (strlen($desc) == 100)
      $desc .= "...";
  }
  echo "<tr><td class='pkgname'>";
  echo "<a href=\"details.php?name=" . urlencode($name) . "\">" . $name . "</a>";
  echo "</td><td>" . $desc . "</td></tr>\n";
}
?>
</table>
</div>
</div>
</body>
</html>
