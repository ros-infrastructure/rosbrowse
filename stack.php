<?php
$title = $_GET['name'];
include "rosbrowse.inc";
//include "load_megastack.inc";
//$xquery = "/stacks/stack[@name='{$_GET['name']}']";
//$stack = $stacks_xml->xpath($xquery);
//$stack = $stack[0];
//$stacks = yaml_parse(file_get_contents('megastack.yaml'));
$stack = yaml_parse(file_get_contents('/var/www/www.ros.org/html/doc/api/' . $_GET['name'] . '/stack.yaml')); //file_get_contents('manifest-gt.yaml'));

//print_r($stack);
?>
<div id="dpage">
  <div id="dpage-inner">

<h1><?php echo $stack['name']; ?></h1>
<p><i><?php echo (string)$stack['brief']; ?></i></p>
<p><b>Author(s):</b> <?php echo $stack['authors']; ?></p>
<p><b>License:</b> <?php echo $stack['license']; ?></p>
<!--<p><b>Repository:</b> <?php echo $stack['repository'] ?> &nbsp;&nbsp; <a href="http://ros.org/browse/repo.php?repo_host=<?php echo $stack['repo_host'] . $stack['path']; ?>"> browse code </a></p>-->
<p><b>Source:</b> <a href="<?php echo $stack['vcs_uri'] ?>"><?php echo $stack['vcs_uri'] ?></a></p>
<?php if (strlen($stack['url']) > 1) { ?>
<p><b>Website:</b> <a href="<?php echo $stack['url'] ?>"><?php echo $stack['url']; ?></a></p>
<?php } ?>
<?php if ($stack['depends']) { ?>
<p><b>Dependencies:</b>
<?php
foreach($stack['depends'] as $s)
{
  echo "<a href=\"stack.php?name=" . $s . "\">" . $s . "</a>&nbsp;&nbsp;&nbsp; ";
}
?>
</p>
<?php } ?>
<p><b>Description:</b> <?php echo $stack['description']; ?></p>
<hr />
<p><b>Packages:</b>
<ul>
<?php
foreach($stack['packages'] as $pkg)
{
  echo "<li><a href=\"details.php?name=".$pkg."\">".$pkg."</a></li>";
}
?>
</ul>
<hr />
<p><a href="stack_list.php">Return to list of all stacks</a></p>
</table>
</div>
</div>
</body>
</html>

