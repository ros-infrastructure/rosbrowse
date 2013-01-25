<?php
$title = "search results";
include "rosbrowse.inc";
$pkgs = yaml_parse(file_get_contents('megamanifest.yaml'));
$stacks = yaml_parse(file_get_contents('megastack.yaml'));
$package_results = array();
$stack_results = array();
?>
<div id="dpage">
  <div id="dpage-inner"/>

<?php
function alpha_cb($a, $b)
{
  return strcmp(strtoupper($a['name']), strtoupper($b['name']));
}
usort($pkgs, "alpha_cb");
//usort($stacks, "alpha_cb");
$query = strtoupper($_GET['q']);
if (strlen($query) > 0)
{
  foreach($pkgs as $pkg)
  {
    $brief_desc = strtoupper((string)$pkg['brief']);
    $desc = strtoupper((string)$pkg['description']);
    $name = strtoupper((string)$pkg['name']);
    if (strpos($brief_desc, $query) !== false ||
        strpos($desc, $query) !== false ||
        strpos($author, $query) !== false ||
        strpos($name, $query) !== false)
      $package_results[] = $pkg;
  }
  // copying this logic in case we want to do something different in the future,
  // like search for dependencies or whatever
  foreach($stacks as $stack)
  {
    $brief_desc = strtoupper((string)$stack['brief']);
    $desc = strtoupper((string)$stack['description']);
    $name = strtoupper((string)$stack['name']);
    if (strpos($brief_desc, $query) !== false ||
        strpos($desc, $query) !== false ||
        strpos($author, $query) !== false ||
        strpos($name, $query) !== false)
      $stack_results[] = $stack;
  }
}  
$query_string = $_GET['q'];
$answer = "Found ";
$package_plural = (count($package_results) == 1) ? "package" : "packages";
$stack_plural = (count($stack_results) == 1) ? "stack" : "stacks";

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
<a name="stacks"/><h2>Stacks relating to <?php echo $query_string ?> </h2>
<table>
<tr><th>Name</th><th>Description</th></tr>
<?php
foreach($stack_results as $stack)
{
  $name = (string)$stack['name'];
  $desc = (string)$stack['brief'];
  if (strlen($desc) < 10)
  {
    $desc = (string)$stack['description'];
    $desc = substr($desc, 0, 100);
    if (strlen($desc) == 100)
      $desc .= "...";
  }

  echo "<tr><td class='pkgname'>";
  echo "<a href=\"stack.php?name=" . $name . "\">" . $name . "</a>";
  echo "</td><td>" . $desc . "</td></tr>\n";
}
?>
</table>
<?php } ?>


<?php if (count($package_results) > 0) { ?>
<a name="packages"/><h2>Packages relating to <?php echo $query_string ?> </h2>
<table>
<tr><th>Name</th><th>Description</th></tr>
<?php
foreach($package_results as $pkg)
{
  $name = (string)$pkg['name'];
  $desc = (string)$pkg->description['brief'];
  if (strlen($desc) < 10)
  {
    $desc = (string)$pkg->description; //).substr(0, 100);
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
<?php } ?>

</div>
</div>
</body>
</html>

