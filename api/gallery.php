

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!--Scripts (jQuery + LightBox Plugin + imgallery Script)-->
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.lightbox.js"></script>
<script type="text/javascript" src="js/imgallery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $("#gallery").lightBox();
});
</script>
 
<!--CSS (LightBox CSS + imgallery CSS)-->
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="css/jquery.lightbox-0.5.css" />
<link rel="stylesheet" type="text/css" href="css/imgallery.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<title>TwitPic Scrapped Photos</title>
</head>

<body>
<div id="header">
		<div>
			
			<div id="navigation">
				<div>
					<ul>
					<li class="current"><a href="index.php">Home</a></li>
						<li><a href="about.php">About us</a></li>
						<li><a href="testPicture.php">User-Photos</a></li>
						<li><a href="gallery.php">Gallery</a></li>
						
					</ul>
					
	
				</div>
				
			</div>
			
			
		</div>
		</div>
		
		<div id="gallery">
		<!-- Images !-->
		<?php
		//image gallery php class

        include('imgallery.php');
		
		echo "<center><h3>TwitPic scrapped Photos</h3></center><br";
		echo "<center>";
		ImgGallery::getPublicSide();
		echo "</center>";
		?>
		
	
		</div>
		
		
		
		
	

</body>
</html>
