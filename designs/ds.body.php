		<!-- awal div bagian mainpage body -->
		<div class="row" style="margin-bottom:30px;">
			<div class="bottom10">
				<div class="col-md-1"></div>
				<div id="page-wrap" class="col-md-10 nopadding">
					<?php
					//cek pake menu samping atau tidak
					if(isset($_SESSION["log_auth_id"]) && $_SESSION["log_auth_id"]<>"" && isset($menu[0]["menu_show_inner"]) && $menu[0]["menu_show_inner"]=="y" ) {
					?>
						<div class="col-md-3 nopadding">
							<?php
							include(_PATHDIRECTORY."/designs/ds.innermenu.php");
							?>
						</div>
						<div class="col-md-9">
							<?php
							system_loadPage($menu);
							?>
						</div>
					<?php
					}
					else {
					?>
						<div class="col-md-12">
						<?php
							system_loadPage($menu);
						?>
						</div>
					<?php
					}
					?>
				</div>
				<div class="col-md-1"></div>
			</div>
		</div>