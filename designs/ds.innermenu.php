<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Personal Data <i>(Data Pribadi)</i></h3>
  </div>
  <div class="panel-body">
    <div class="list-group" id="menu-list">
      <?php
      if (
        isset($_SESSION["log_auth_id"]) &&
        isset($_SESSION["log_auth_name"]) &&
        isset($_SESSION["priv_id"]) &&
        in_array($_SESSION["priv_id"], array("candid"))
      ) {
        $q = querying(
          "SELECT * FROM m_menu WHERE menu_show = ? AND menu_type = ? AND status_id = ? ORDER BY menu_order ASC",
          array("y", "inner", "active")
        );
        $innermenu = sqlGetData($q);

        $datapplication = getDataApply();

        $hideMenu = false;
        $disableMenu = false;
        

        if (
          isset($datapplication[0]["candidate_apply_stage"]) &&
          $datapplication[0]["candidate_apply_stage"] !== "offering"
        ) {
          $hideMenu = true;
          $disableMenu = true;
        } elseif (!isset($datapplication[0]["candidate_apply_stage"]) || $datapplication[0]["candidate_apply_stage"] == 0) {
          $hideMenu = true;
          $disableMenu = true;
        }

        foreach ($innermenu as $menu2) {
          $menuUrl = _PATHURL . "/" . url_slug($menu2["menu_name"]) . "/";
          $menuClass = "list-group-item";

          // Check for specific candidate_apply_stage to hide menu2
          if (
            $hideMenu &&
            in_array(
              $menu2["menu_name"],
              array(
                "education",
                "workingexp",
                "organization",
                "training",
                "skills",
                "language",
                "family",
                "questionaire"
              )
            )
          ) {
            continue; // Skip this menu item
          }

          // Check for specific menu_name to disable menu2
          if (
            $disableMenu &&
            in_array(
              $menu2["menu_name"],
              array(
                "resume",
              )
            )
          ) {
            echo '<span class="' . $menuClass . ' disabled">';
            echo '<i class="fa ' . $menu2["menu_icon"] . ' fa-fw"></i>&nbsp;' . $menu2["menu_title"];
            echo '</span>';
          } else {
            echo '<a class="' . $menuClass . '" href="' . $menuUrl . '">';
            echo '<i class="fa ' . $menu2["menu_icon"] . ' fa-fw"></i>&nbsp;' . $menu2["menu_title"];
            echo '</a>';
          }
        }
      }
      ?>
    </div>
    <div class="list-group">
      <a class="list-group-item" style="background-color:#fe8992;" href="<?php echo _PATHURL; ?>/logout.php">
        <i class="fa fa-sign-out fa-fw"></i>&nbsp; Logout
      </a>
    </div>
  </div>
</div>
