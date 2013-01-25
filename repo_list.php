<?php
$title = "ROS repositories";
include "rosbrowse.inc";
$all_pkgs = yaml_parse(file_get_contents('megamanifest.yaml'));
$repos_dups = array();
$repo_pkg_counts = array();
foreach ($all_pkgs as $p)
{
  array_push($repos_dups, $p['repo']);
  if (array_key_exists($p['repo'], $repo_pkg_counts))
    $repo_pkg_counts[$p['repo']] += 1;
  else
    $repo_pkg_counts[$p['repo']] = 1;
}
$repos = array_unique($repos_dups);
?>
<div id="dpage">
  <div id="dpage-inner">
<h1>Browsable Package Repositories</h1>
<table>
<tr><th>Name</th><th>Packages</th></tr>
<?php
function alpha_cb($a, $b)
{
  return strcmp(strtoupper($a), strtoupper($b));
}
usort($repos, "alpha_cb");

foreach($repos as $repo)
{
  //$repo_pkgs = $xml->xpath("/pkgs/package[@repo_host='".$repo."']");
  echo "<tr><td class='pkgname'>";
  echo "<a href=\"repo.php?repo_host=" . $repo . "\">" . $repo. "</a>";
  echo "</td><td>";
  echo $repo_pkg_counts[$repo];
  //echo count($repo_pkgs);
  echo "</td></tr>\n";
}
?>
</table>
</div>
</div>

</body>
</html>
