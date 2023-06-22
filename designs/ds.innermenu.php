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
        // var_dump($datapplication);exit;

        foreach ($innermenu as $menu2) {
          $menuUrl = _PATHURL . "/" . url_slug($menu2["menu_name"]) . "/";
          $menuClass = "list-group-item";

          // Check for specific candidate_apply_stage to hide menu2
          if (
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
                "document",
                "questionaire"
              )
            )
          ) {
            if (
              isset($datapplication["candidate_apply_stage"]) && $datapplication["candidate_apply_stage"] === "offering"
              && $menu2["status_id"] === "active"
            ) {
              $menuClass .= " hidden";
            }
          }
      ?>
          <a class="<?php echo $menuClass; ?>" href="<?php echo $menuUrl; ?>">
            <i class="fa <?php echo $menu2["menu_icon"]; ?> fa-fw"></i>&nbsp; <?php echo $menu2["menu_title"]; ?>
          </a>
      <?php
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

<script>
  document.addEventListener("DOMContentLoaded", function() {
    var menuList = document.getElementById("menu-list");
    var dataStage = "<?php echo isset($datapplication['candidate_apply_stage']) ? $datapplication['candidate_apply_stage'] : ''; ?>";

    var menuItems = menuList.getElementsByClassName("list-group-item");
    for (var i = 0; i < menuItems.length; i++) {
      var menuItem = menuItems[i];
      var menuName = menuItem.getAttribute("href").replace(/\/$/, "").split("/").pop();

      if (
        ["education", "workingexp", "organization", "training", "skills", "language", "family", "document", "questionaire"].includes(menuName)
        && dataStage !== "offering"
      ) {
        menuItem.classList.add("hidden");
      } else {
        menuItem.classList.remove("hidden");
      }
    }
  });
</script>
