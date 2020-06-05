<?php
$title = "search results";
include "rosbrowse.inc";

$distro = 'noetic';
$distro_list = array("fuerte", "groovy", "hydro", "indigo", "jade", "kinetic", "lunar", "melodic", "noetic");
if (isset($_GET['distro']) && !empty($_GET['distro']))
{
  $distro = $_GET['distro'];
}

$pkgs = get_packages($distro, 'package');
$stacks = get_packages($distro, 'stack');
$metapackages = get_packages($distro, 'metapackage');
$stacks = array_merge($stacks, $metapackages);
$package_results = array();
$stack_results = array();
?>
<div id="dpage">
  <div id="dpage-inner"/>

<?php
ksort($pkgs);
ksort($stacks);
$query = strtoupper($_GET['q']);
if (strlen($query) > 0)
{
  foreach($pkgs as $name => $pkg)
  {
    $brief_desc = strtoupper((string)$pkg['brief']);
    $desc = strtoupper((string)$pkg['description']);
    $authors = strtoupper((string)$pkg['authors']);
    $maintainers = strtoupper((string)$pkg['maintainers']);
    if (strpos($brief_desc, $query) !== false ||
        strpos($desc, $query) !== false ||
        strpos($authors, $query) !== false ||
        strpos($maintainers, $query) !== false ||
        strpos(strtoupper($name), $query) !== false)
      $package_results[$name] = $pkg;
  }
  // copying this logic in case we want to do something different in the future,
  // like search for dependencies or whatever
  foreach($stacks as $name => $stack)
  {
    $brief_desc = strtoupper((string)$stack['brief']);
    $desc = strtoupper((string)$stack['description']);
    $authors = strtoupper((string)$pkg['authors']);
    $maintainers = strtoupper((string)$pkg['maintainers']);
    if (strpos($brief_desc, $query) !== false ||
        strpos($desc, $query) !== false ||
        strpos($authors, $query) !== false ||
        strpos($maintainers, $query) !== false ||
        strpos(strtoupper($name), $query) !== false)
      $stack_results[$name] = $stack;
  }
}  
$query_string = $_GET['q'];
$answer = "Found ";
$package_plural = (count($package_results) == 1) ? "package" : "packages";
$stack_plural = (count($stack_results) == 1) ? "metapackage/stack" : "metapackages/stacks";

if (count($stack_results) > 0)
{
  $answer .= "<a href=\"#stacks\">" . count($stack_results) . " " . $stack_plural . "</a> ";  
  if (count($package_results) > 0)
    $answer .= " and ";
}
if (count($package_results) > 0)
{
  $answer .= "<a href=\"#packages\">" . count($package_results) . " " . $package_plural . "</a> ";  
}
else
  $answer = "Didn't find anything ";
$answer .= "relating to '" . $query_string . "'";

?>

<p><?php echo $answer ?></p>

<?php if (count($stack_results) > 0) { ?>
<a name="stacks"/><h2>Stacks or Metapackages relating to '<?php echo $query_string ?>'</h2>
<table>
<tr>
  <th>Name</th>
  <th>Maintainers / Authors</th>
  <th>Description</th>
</tr>
<?php
foreach($stack_results as $name => $stack)
{
  $desc = (string)$stack['brief'];
  if (strlen($desc) < 10)
  {
    $desc = (string)$stack['description'];
    $desc = substr($desc, 0, 100);
    if (strlen($desc) == 100)
      $desc .= "...";
  }
  $maintainers = format_names($stack['maintainers']);
  $authors = format_names($stack['authors']);
  $maintainers_and_authors = $maintainers + $authors;
  echo '<tr><td class="pkgname"><a href="details.php?distro=' . urlencode($distro) . '&name=' . urlencode($name) . '">' . $name . '</a></td><td>' . implode(', ', $maintainers_and_authors) . '</td><td>' . htmlentities($desc) . '</td></tr>';
  echo "\n";
}
?>
</table>
<?php } ?>


<?php if (count($package_results) > 0) { ?>
<a name="packages"/><h2>Packages relating to '<?php echo $query_string ?>'</h2>
<table>
<tr>
  <th>Name</th>
  <th>Maintainers / Authors</th>
  <th>Description</th>
</tr>
<?php
foreach($package_results as $name => $pkg)
{
  $desc = (string)$pkg['brief'];
  if (strlen($desc) < 10)
  {
    $desc = (string)$pkg['description']; //).substr(0, 100);
    $desc = substr($desc, 0, 100);
    if (strlen($desc) == 100)
      $desc .= "...";
  }
  $maintainers = format_names($pkg['maintainers']);
  $authors = format_names($pkg['authors']);
  $maintainers_and_authors = $maintainers + $authors;
  echo '<tr><td class="pkgname"><a href="details.php?distro=' . urlencode($distro) . '&name=' . urlencode($name) . '">' . $name . '</a></td><td>' . implode(', ', $maintainers_and_authors) . '</td><td>' . htmlentities($desc) . '</td></tr>';
  echo "\n";
}
?>
</table>
<?php } ?>

</div>
</div>
</body>
</html>

