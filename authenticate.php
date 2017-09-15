<?php 
$colors = array(
	array("#F44336", "#B71C1C"),
	array("#E91E63", "#880E4F"),
	array("#3F51B5", "#1A237E"),
	array("#2196F3", "#0D47A1"),
	array("#03A9F4", "#01579B"),
	array("#00BCD4", "#006064"),
	array("#009688", "#004D40"),
	array("#4CAF50", "#1B5E20"),
	array("#8BC34A", "#33691E"),
	array("#CDDC39", "#827717"),
	array("#FFC107", "#FF6F00"),
	array("#FF9800", "#E65100"),
	array("#FF5722", "#BF360C")
);
$color = $colors[ array_rand($colors,1)];
include("inc/html/head.php");
?>
<style>
body:before{background-color: <?php echo $color[0]; ?>;}
a{color:<?php echo $color[0]; ?>;}
.main{max-width: 1000px;padding:.5rem 0;}
button.submit{border: 3px solid <?php echo $color[0]; ?>; color:<?php echo $color[0]; ?>;}
button.submit:after{background: <?php echo $color[0]; ?>;}
input:focus{border-color: <?php echo $color[0]; ?>;color: <?php echo $color[1]; ?>;}
</style>
</head><body id="body">
<nav id="navigation">
	<div class="title">
		<a href="index.php">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1800 1800"><path d="M932.14 845.75q0-14.05-9.04-23.1-9.04-9.03-23.1-9.03-66.3 0-113.5 47.2-47.2 47.17-47.2 113.43 0 14.05 9.03 23.1 9.04 9.02 23.1 9.02 14.06 0 23.1-9.03 9.04-9.04 9.04-23.1 0-40.15 28.13-68.26 28.12-28.1 68.3-28.1 14.06 0 23.1-9.04 9.04-9.04 9.04-23.1zm225 130.5q0 106.42-75.33 181.7-75.32 75.3-181.8 75.3-106.46 0-181.8-75.3-75.33-75.28-75.33-181.7 0-106.4 75.33-181.7 75.33-75.3 181.8-75.3 106.47 0 181.8 75.3 75.34 75.3 75.34 181.7zM128.57 1552.5h1542.86V1424H128.57v128.5zM1285.7 976.26q0-159.62-113-272.56T900 590.76q-159.7 0-272.7 112.94t-113 272.56q0 159.62 113 272.56T900 1361.76q159.7 0 272.7-112.94t113-272.56zM257.15 331.76h385.72v-128.5H257.14v128.5zM128.57 524.5h1542.86v-257h-831.7L775.45 396H128.57v128.5zM1800 267.5v1285q0 53.2-37.67 90.85-37.66 37.65-90.9 37.65H128.57q-53.24 0-90.9-37.65Q0 1605.7 0 1552.5v-1285q0-53.2 37.67-90.85Q75.33 139 128.57 139h1542.86q53.24 0 90.9 37.65Q1800 214.3 1800 267.5z" fill="#fff"/></svg>
			OpenGallery<span id="albumname">Authenticate</span>
		</a>
	</div>
</nav>


	<div class="box authenticate">
		Anything went wrong!</br>
		Please enter the AlbumID you are looking for to continue. 
		<div class="cssbutton help">
			<svg xmlns="http://www.w3.org/2000/svg" fill="#000" width="1rem" height="1rem" viewBox="50 50 412 412"><path d="M256 90c91.74 0 166 74.24 166 166 0 91.74-74.25 166-166 166-91.74 0-166-74.25-166-166 0-91.74 74.24-166 166-166m0-40C142.23 50 50 142.23 50 256s92.23 206 206 206 206-92.23 206-206S369.77 50 256 50zm2.02 329.5c-14.54 0-26.34-11.8-26.34-26.34s11.8-26.33 26.34-26.33c14.55 0 26.35 11.8 26.35 26.33 0 14.55-11.8 26.35-26.35 26.35zm20.72-77.85v4.74H235.3v-4.75c0-13.4 1.97-30.6 17.54-45.57 15.56-14.96 35.02-27.3 35.02-46 0-20.65-14.34-31.58-32.4-31.58-30.13 0-32.1 31.24-32.84 38.12H180.4c1.1-32.57 14.88-78.13 75.3-78.13 52.37 0 75.9 35.06 75.9 67.95 0 52.34-52.87 61.44-52.87 95.2z"/></svg>
			<div class="inner">
				<p>The AlbumID is the string behind the <b>?a=</b> in the link you got.</p>
				<p>For example:</p>
				<p style="padding-left:1rem; font-size:.75em;">https://gallery.hackedit.de/?a=<b>auVdWPtgZzEMwIKdt9</b></p>
			</div>
		</div>
		<form action="index.php" autocomplete="off" method="GET">
			<input type="search" id="id" name="a" class="fullinput" placeholder="auVdWPtgZzEMwIKdt9" required></br>
			<button type="submit" class="submit fullinput">Go...</button>
		</form>
</div>