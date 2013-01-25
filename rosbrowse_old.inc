<?php header("Content-type: text/html; charset=utf-8"); ?>
<html>
  <head>
  <title><?php echo $title; ?></title>

    <link rel="stylesheet" href="rosbrowse.css" type="text/css" media="screen"/>

<link rel="stylesheet" type="text/css" charset="utf-8" media="all" href="/moin_static182/rostheme/css/common.css">
<link rel="stylesheet" type="text/css" charset="utf-8" media="screen" href="/moin_static182/rostheme/css/screen.css">
<link rel="stylesheet" type="text/css" charset="utf-8" media="print" href="/moin_static182/rostheme/css/print.css">
<link rel="stylesheet" type="text/css" charset="utf-8" media="projection" href="/moin_static182/rostheme/css/projection.css">

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-17821189-2']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

  </head>
<body>

<div id="dpage">
  <div id="dpage-inner">

<div id="header"><div id="topnav">
      <table id="topnav-table">
        <tr>
          <td width="320" valign="top"><a href="/"><img border="0" src="/images/ros_org.png" alt="ros.org" width="238" height="51"/></a></td>

          <td valign="middle">
            <a href="/wiki/About%20ros.org">About</a>
            |
            <a href="/wiki/Support">Support</a>
            |
            <a href="http://answers.ros.org/">answers.ros.org</a>
          </td>


          <td valign="middle" align="right">


<script language="Javascript">
site = " more:ros_wiki_docs"; // your site name

function Searchy(theButton){

theForm = theButton.form;
newID = theForm.input.value + site;
theForm.q.value = newID;
theForm.input.value=theForm.input.value

}
</script>


<form action="http://www.ros.org/search/index.html" id="cse-search-box">
  <div>
    <label>Search:</label>
    <input type="hidden" name="cx" value="013029357434904786434:afn5eukzpgg" />
    <input type="hidden" name="cof" value="FORID:11;NB:1" />
    <input type="hidden" name="ie" value="UTF-8" />
    <input type="hidden" name="filter" value="0" />
    <input type="hidden" name="num" value="10" />
    <input type="text" name="input" id="input" autocomplete="on" style="width: 35%"/>
    <input type="hidden" name="q" value="" />
    <input type="submit" name="sa" value="Submit" onClick="Searchy(this)"/>

  </div>
</form>


         </td>
      </tr>

      <tr>
        <td colspan="3" height="53" width="1024"><nobr><img src="/images/menu_left.png" width="17" height="53" alt=""/><a href="/wiki/"><img
        border="0" src="/images/menu_documentation.png" width="237" height="53" alt="Documentation" /></a><img
        src="/images/menu_spacer.png" width="69" height="53" /><a href="http://www.ros.org/browse/"><img border="0"
        src="/images/menu_browse_software.png" width="268" height="53" alt="Browse Software" /></a><img
        src="/images/menu_spacer.png" width="69" height="53" /><a href="http://www.ros.org/news"><img border="0"
        src="/images/menu_news.png" width="84" height="53" alt="News" /></a><img
        src="/images/menu_spacer.png" width="69" height="53" /><a href="http://www.ros.org/wiki/ROS/Installation"><img border="0"
        src="/images/menu_download.png" width="151" height="53" alt="Download" /></a><img
        src="/images/menu_right.png" width="60" height="53" /></nobr></td>
      </tr>
    </table> <!-- topnav-table -->
    </div> <!-- /#topav -->
  </div> <!-- /#header -->



<div id="page" lang="en" dir="ltr"><!--page-->
<div dir="ltr" id="content" lang="en"><span class="anchor" id="top"></span>

<table class="menu" width="100%" border="0">
  <tr>
    <td width="20%" class="menu"><a class="menu" href="list.php">packages</a></td>
    <td width="20%" class="menu"><a class="menu" href="repo_list.php">repositories</a></td>
    <td width="20%" class="menu"><a class="menu" href="stack_list.php">stacks</a></td>
    <td width="40%" class="menu"><form style="display:inline" method="get" action="search.php"><input name="q"></input>&nbsp;<input type="submit" value="search"/></form></td>
  </tr>
</table>
</div>
</div><!--page-->
</div>
</div>
