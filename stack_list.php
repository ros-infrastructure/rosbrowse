<?php
$title = "ROS stacks";
include "rosbrowse.inc";
$stacks = yaml_parse(file_get_contents('megastack.yaml'));
?>
<div id="dpage">
  <div id="dpage-inner">

<table>
<tr><th>Name</th><th>Description</th></tr>
<?php
function alpha_cb($a, $b)
{
  return strcmp(strtoupper($a['name']), strtoupper($b['name']));
}
usort($stacks , "alpha_cb");
foreach($stacks as $stack)
{
  //print_r($stack);
  //echo "<br/><hr/><br/>\n";
  $name = (string)$stack['name'];
  $pkg_count = count($stack->package);
  $desc = (string)$stack['brief'];
  if (strlen($desc) < 10) // there was no brief description
  {
    $desc = (string)$stack['description'];
    $desc = substr($desc, 0, 100); // make the real description brief...
    if (strlen($desc) == 100)
      $desc .= "..."; // and admit we chopped it CHOMP CHOMP
  }

  echo "<tr><td class='pkgname'>";
  echo "<a href=\"stack.php?name=" . urlencode($name) . "\">" . $name. "</a>";
  echo "</td><td>" . $desc . "</td></tr>\n";
}
?>
</table>
</div>
</div>
</body>
</html>
