<?php
//munculkan primary menu dari database
$q = querying("SELECT * FROM m_menu WHERE menu_show = ? and menu_type = ? and status_id = ? ORDER BY menu_order ASC",array("y","admprimary","active"));
$primarymenu = sqlGetData($q);
//print_r($primarymenu);
//exit;
echo "<ul class=\"nav nav-sidebar\">";
for($i=0;$i<count($primarymenu);$i++) {

	echo "<li ".((isset($_GET["mod"]) && $_GET["mod"]==$primarymenu[$i]["menu_name"])?" class='active' ":"")."><a href=\""._PATHURL."/".url_slug($primarymenu[$i]["menu_name"])."/\"><i class=\"fa ".$primarymenu[$i]["menu_icon"]." fa-fw\"></i>&nbsp;".$primarymenu[$i]["menu_title"]."</a></li>";
}
echo "</ul>";
?>
	<ul class="nav nav-sidebar">
		<li><a class="list-group-item" style="background-color:#fe8992; color:#ffffff;" href="<?php echo _PATHURL;?>/logout.php"><i class="fa fa-sign-out fa-fw"></i>&nbsp; Logout</a></li>
	</ul>
