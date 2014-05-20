<?php
require 'menu.php';
?>
<row>
	<div class="span8 offset2">

	<table><thead><th><p><h2 align="center">Upload</h2></p></th></thead><tbody><tr><td></td></tr></tbody></table>
	<div class="hero-unit">
			<form enctype="multipart/form-data" action="<?php echo BASE_URI.'/Session/Uploaded'; ?>" method="post" align="center">
    			<div style="position:relative;">
					<a class='btn btn' href='javascript:;'>
						<i class=" icon-folder-open"></i>
						Selectionner...
						<input type="file" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="nomfichier" size="40"  onchange='$("#upload-file-info").html($(this).val());'>
					</a>
					&nbsp;
				<span class='label label-info' id="upload-file-info"></span>
				</div>
  				<br /><br />
				<button class="btn primary" type="file"><i class="icon-white icon-circle-arrow-up"></i> Upload</button>
			</form>
		</div>
		<table><thead><th><p><h5 align="center"><a href="<?php echo BASE_URI.'/Session/ResUpload'; ?>">Fichiers Uploadés</a></h5></p></th></thead><tbody><tr><td></td></tr></tbody></table>
		</div>
	</row>