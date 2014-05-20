 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="Author" content="Daniel Hagnoul" />
	<title>Page type</title>
	<style type="text/css">
		body {
			background-color:#696969;
			color:#000000;
			font-family:Arial, Helvetica, sans-serif;
			font-size:medium;
			font-style:normal;
			font-weight:normal;
			line-height:normal;
			letter-spacing:normal;
		}
		h1,h2,h3,h4,h5 {
			font-family:"Times New Roman", Times, serif;
		}
		div,p,h1,h2,h3,h4,h5,h6,ul,ol,dl,form,table,img {
			margin:0px;
			padding:0px;
		}
		p {
			padding:6px;
		}
		ul,ol,dl {
			list-style:none;
			padding-left:6px;
			padding-top:6px;
		}
		li {
			padding-bottom:6px;
		}
		div#conteneur {
			width:95%;
			margin:12px auto;
			padding:6px;
			background-color:#FFFFFF;
			color:#000000;
			border:1px solid #666666;
			font-size:0.8em;
		}
 
		/* TEST */
		div.montreDiv {
			display:block;
			width:400px;
			padding:6px;
			border:1px solid red;
		}
		div.cacheDiv {
			display:none;
		}
	</style>
	<!-- <script type="text/javascript" src="http://jqueryjs.googlecode.com/files/jquery-1.3.2.js"></script> -->
	<script type="text/javascript" src="../lib/jquery-1.3.2.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#maSelection").change(function(){
				var id = "divID" + $("option:selected", this).val();
 
				$(".montreDiv").removeClass("montreDiv").addClass("cacheDiv");
				$("#"+id).removeClass("cacheDiv").addClass("montreDiv");
			});
		});
	</script>
</head>
<body>
	<div id="conteneur">
		<select id="maSelection" >
			<option value="1">Option n° 1</option>
			<option value="2">Option n° 2</option>
			<option value="3" selected="selected">Option n° 3</option>
		</select>
		<div id="divID1" class="cacheDiv">
			<p>
				Aliquam erat volutpat. Sed sagittis leo et elit. Vivamus blandit venenatis nisl. Fusce lectus. Curabitur venenatis magna vel est. Sed enim turpis, luctus ut, convallis at, rhoncus at, purus. Fusce congue tempor tellus. Suspendisse sit amet nisl. Donec congue orci nec augue. Aliquam egestas venenatis mi. Ut elit velit, imperdiet fermentum, ullamcorper vitae, tincidunt facilisis, diam. Mauris vitae erat.
			</p>
		</div>
		<div id="divID2" class="cacheDiv">
			<p>
				Quisque ac lacus. Aliquam erat volutpat. Vestibulum fringilla accumsan est. Mauris ipsum mauris, scelerisque vitae, aliquet aliquam, imperdiet sit amet, risus. Aliquam tincidunt. Vestibulum sit amet leo non dolor porttitor laoreet. Mauris convallis sagittis tortor. Integer eget purus et enim porttitor ullamcorper. Sed molestie nisi quis justo. Cras et enim. Mauris nec purus. Vestibulum vitae magna vel augue vehicula sodales. Fusce id justo. Fusce dolor nisi, tincidunt in, consectetur at, ornare rhoncus, eros.
			</p>
		</div>
		<div id="divID3" class="montreDiv">
			<p>
				Etiam at augue. Cras ac lorem. Vestibulum tempus est sit amet urna. In auctor libero. Sed hendrerit, augue et mollis bibendum, elit eros fringilla erat, at tempor risus dolor a tellus. Vivamus id odio eu risus pharetra rutrum. Ut id felis. Ut porttitor aliquet ante. Aenean nibh est, accumsan eu, sollicitudin in, vulputate a, ipsum. Duis vitae tellus a neque tempus tristique. Suspendisse vel felis ullamcorper nunc dignissim dictum.
			</p>
		</div>
	</div>
</body>
</html>