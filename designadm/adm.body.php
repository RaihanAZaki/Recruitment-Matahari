		<!-- awal div bagian adm body -->
        <div class="col-sm-9 col-md-10 main">
          
			<!--toggle sidebar button-->
			<p class="visible-xs">
			<button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="glyphicon glyphicon-chevron-left"></i></button>
			</p>

			<div>
				<?php
					system_loadPage($menuadm);
				?>
			</div>
		</div>
		<!-- ini akhir div adm body -->