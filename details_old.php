<?php
$title = $_GET['name'];
include "rosbrowse.inc";
$pkg = yaml_parse(file_get_contents('/var/www/www.ros.org/html/doc/api/' . $_GET['name'] . '/manifest.yaml'));
?>
<div id="dpage">
<div id="dpage-inner">
<h1><?php echo $pkg['name']; ?></h1>
<?php if (strlen($pkg['brief']) > 1) { ?>
<p><i><?php echo (string)$pkg['brief']; ?></i></p>
<?php } ?>
<p><b>Author(s):</b> <?php echo $pkg['authors']; ?></p>
<p><b>License:</b> <?php echo $pkg['license']; ?></p>
<?php if (strlen($pkg['url']) > 0) { ?>
<p><b>Website:</b> <a href="<?php echo $pkg['url'] ?>"><?php echo $pkg['url'] ?></a></p>
<?php } ?>
<p><b>Source:</b> <a href="<?php echo $pkg['vcs_uri'] ?>"><?php echo $pkg['vcs_uri'] ?></a></p>
<p><b>Dependencies:</b>
<?php
foreach($pkg['depends'] as $dep)
{
  echo "<a href=\"details.php?name=" . $dep . "\">" . $dep . "</a>&nbsp;&nbsp;&nbsp; ";
}
?>
</p>
<p><b>Description:</b> <?php echo $pkg['description']; ?></p>
<hr />
<p><a href="list.php">Return to list of all packages</a></p>
</table>
</div>
</div>
</body>
</html>

