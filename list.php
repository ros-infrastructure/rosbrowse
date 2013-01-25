<?php
$title = 'ROS packages';
include 'rosbrowse.inc';

$package_type = 'package';
$package_type_list = array('package', 'stack', 'metapackage');
if (isset($_GET['package_type']) && !empty($_GET['package_type']))
{
  $package_type = $_GET['package_type'];
}

$distro = 'groovy';
$distro_list = array('fuerte', 'groovy');
if (isset($_GET['distro']) && !empty($_GET['distro']))
{
  $distro = $_GET['distro'];
}

$pkgs = get_packages($distro, $package_type);

function format_names($names)
{
  $names = preg_split('/(,|;)/', $names);
  $retval = array();
  foreach($names as $name)
  {
    $name = utf8_decode($name);
    $name = strip_tags($name); // get rid of emails embedded as <..>
    $name = htmlentities(trim($name));
    if ($name)
    {
      $retval[] = $name;//str_replace(' ', '&nbsp;', $name);
    }
  }
  return $retval;
}
?>
<div id="dpage">
  <div id="dpage-inner">
<table>
<tr>
<?php 
  foreach($distro_list as $d) 
  {
    echo '<td><a href="list.php?package_type=' . $package_type . '&distro=' . $d . '"' . ($d == $distro ? ' style="font-weight: bold;"' : '') . '>' . $d . '</a></td>';
  }
?>
</tr>
<tr>
<?php 
  foreach($package_type_list as $p) 
  {
    echo '<td><a href="list.php?package_type=' . $p . '&distro=' . $distro . '"' . ($p == $package_type ? ' style="font-weight: bold;"' : '') . '>' . $p . 's</a></td>';
  }
?>
<td><form style="display:inline" method="get" action="search.php">
      <input type="hidden" name="distro" value="<?php echo $distro ?>" />
      <input name="q"></input>&nbsp;
      <input type="submit" value="search"/>
</form></td>
</tr>
<tr><td colspan="100"><h2>Browsing <?php echo $package_type ?>s for <?php echo $distro ?></h2></td></tr>
</table>
<table>
<colgroup>
  <col width="1"/>
  <col width="1"/>
  <col width="1"/>
  <col width="1"/>
</colgroup>
<tr>
  <th>Name</th>
  <th>Maintainers / Authors</th>
  <th>Description</th>
</tr>
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
  $maintainers = format_names($pkg['maintainers']);
  $authors = format_names($pkg['authors']);
  $maintainers_and_authors = $maintainers + $authors;
  echo '<tr><td class="pkgname"><a href="details.php?distro=' . urlencode($distroi) . '&name=' . urlencode($name) . '">' . $name . '</a></td><td>' . implode(', ', $maintainers_and_authors) . '</td><td>' . htmlentities($desc) . '</td></tr>';
  echo "\n";
}
?>
</table>
</div>
</div>

</body>
</html>

