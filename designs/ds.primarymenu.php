<?php
//munculkan primary menu dari database
$primarymenu=designGetMenu("primary", "y", "active");
$nologinmenu=designGetMenu("upperight","y","active");
//print_r($primarymenu);exit;
?>
          <!-- Static navbar -->
          <div class="navbar navbar-blue" role="navigation">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle pull-left" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>

				<div class="col-md-1"></div>
				<div class="col-md-10">
					<div id="navbar" class="navbar-collapse collapse ">
						<ul class="nav navbar-nav">
						<?php
						for($i=0;$i<count($primarymenu);$i++) {
						echo "<li ".((isset($_GET["mod"]) && $_GET["mod"]==$primarymenu[$i]["menu_name"])?" class='active' ":"")." id='".$primarymenu[$i]["menu_color"]."'><a href=\""._PATHURL."/".url_slug($primarymenu[$i]["menu_name"])."/\"><i class=\"fa ".$primarymenu[$i]["menu_icon"]."\"></i>&nbsp;".$primarymenu[$i]["menu_title"]."</a></li>";
						}
						?>
						</ul>
						<?php
						if(isset($_SESSION["log_auth_id"]) && $_SESSION["log_auth_id"]<>"" && isset($_SESSION["priv_id"]) && $_SESSION["priv_id"]=="candid") {
						?>
						<!--
						<ul class="nav navbar-nav navbar-right nopadding">
						  <li><a href="<?php echo _PATHURL;?>/logout.php"><i class="fa fa-sign-out"></i> Logout</a></li>
						</ul>
						-->
						<ul class="nav navbar-nav navbar-right nopadding">
							<li class="dropdown">
								<a href="#" style="background-color:#fe8992;" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i> <?php echo $_SESSION["log_auth_name"];?><span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a href="<?php echo _PATHURL;?>/resume/"><i class="fa fa-user"></i> Personal Data</a></li>
									<li><a href="<?php echo _PATHURL;?>/logout.php"><i class="fa fa-sign-out"></i> Logout</a></li>
								</ul>
							</li>
						</ul>
						<?php
						}
						else if (isset($_SESSION["log_auth_id"]) && $_SESSION["log_auth_id"]<>"" && isset($_SESSION["priv_id"]) && $_SESSION["priv_id"]=="admin") {
						?>
						<ul class="nav navbar-nav navbar-right nopadding">
						  <li style="background-color:#fda100;">LOGOUT</li>
						</ul>
						<?php
						}
						else {
							
						?>
						<ul class="nav navbar-nav navbar-right nopadding">
							<li class="dropdown">
								<a href="#" style="background-color:#fda100;" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-hand-o-right"></i> &nbsp; Start Here! &nbsp; <span class="caret"></span></a>
								<ul class="dropdown-menu">
									<?php
									for($i=0;$i<count($nologinmenu);$i++) {
									echo "<li ".((isset($_GET["mod"]) && $_GET["mod"]==$nologinmenu[$i]["menu_name"])?" class='active' ":"")." id='".$nologinmenu[$i]["menu_color"]."'><a href=\""._PATHURL."/".url_slug($nologinmenu[$i]["menu_name"])."/\"><i class=\"fa ".$nologinmenu[$i]["menu_icon"]." fa-fw\"></i>&nbsp;".$nologinmenu[$i]["menu_title"]."</a></li>";
									}
									?>
								</ul>
							</li>
						</ul>
						<?php
						}
						?>
					</div><!--/.nav-collapse -->
				</div>
				<div class="col-md-1"></div>
          </div>