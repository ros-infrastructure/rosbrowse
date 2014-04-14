<?php
$title = $_GET['name'];
include "rosbrowse.inc";
$distro = 'hydro';
if (isset($_GET['distro']) && !empty($_GET['distro']))
{
  $distro = $_GET['distro'];
}
?>

<div id="dpage">
<div id="dpage-inner">

<?php
$filename = '/home/rosbot/docs/' . $distro . '/api/' . $_GET['name'] . '/manifest.yaml';
if(file_exists($filename))
{

$pkg = yaml_parse(file_get_contents($filename));
if(isset($pkg['vcs_url']))
{
  $vcs_url = $pkg['vcs_url'];
}
else
{
  $vcs_url = $pkg['vcs_uri'];
}
?>
<h1><?php echo $title . " (" . $distro . ")"; ?></h1>
<?php if (strlen($pkg['brief']) > 1) { ?>
<p><i><?php echo (string)$pkg['brief']; ?></i></p>
<?php } ?>
<p><b>Author(s):</b> <?php echo $pkg['authors']; ?></p>
<p><b>Maintainer(s):</b> <?php echo array_key_exists('maintainers', $pkg) ? $pkg['maintainers'] : ''; ?></p>
<p><b>License:</b> <?php echo $pkg['license']; ?></p>
<?php if (strlen($pkg['url']) > 0) { ?>
<p><b>Website:</b> <a href="<?php echo $pkg['url'] ?>"><?php echo $pkg['url'] ?></a></p>
<?php } ?>
<p><b>Source:</b> <a href="<?php echo $vcs_url ?>"><?php echo $vcs_url ?></a></p>
<p><b>Dependencies:</b>
<?php
if ($dep)
{
foreach($pkg['depends'] as $dep)
{
  echo "<a href=\"details.php?distro=" . $distro . "&name=" . $dep . "\">" . $dep . "</a>&nbsp;&nbsp;&nbsp; ";
}
}
?>
</p>
<p><b>Description:</b> <?php echo $pkg['description']; ?></p>
<?php if($pkg['package_type'] == 'stack' || $pkg['package_type'] == 'metapackage')
{ ?>
<hr />
<p><b>Packages:</b>
<ul>
<?php
foreach($pkg['packages'] as $sub_pkg)
{
  echo "<li><a href=\"details.php?name=".$sub_pkg."\">".$sub_pkg."</a></li>";
}
?>
</ul>
<?php
} // if packages
} // if file_exists

if(!file_exists($filename))
{
  echo '<h3>"' . htmlentities($title) . '" is either not a ROS package or not yet indexed.</h3>';
}
?>

<hr />
<p><a href="list.php?<?php if (isset($pkg)) { echo 'package_type=' . $pkg['package_type'] . '&'; } ?>distro=<?php echo $distro; ?>" >Return to list <?php if (isset($pkg)) { echo 'of all ' . $pkg['package_type'] . 's'; } ?></a></p>
</div>
</div>
</body>
</html>

