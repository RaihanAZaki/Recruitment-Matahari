<?php
function designGetMenu($menu_type, $menu_show, $status_id) {
	$query = querying("SELECT * FROM m_menu WHERE menu_type = ? and menu_show = ? and status_id = ? ORDER BY menu_order ASC",array($menu_type, $menu_show, $status_id));
	$menu = sqlGetData($query);
	return $menu;
}

function designGetBanner() {
	$query = querying("SELECT banner_id, banner_name FROM m_banner WHERE banner_active=?", array('y'));
	$banner = sqlGetData($query);
	return $banner;
}
?>