<html><head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
html,body,h1,h2,h3,h4,h5,p,a{margin:0;padding:0; font-family: "Segoe UI", Arial;}
.body{position:relative; line-height: initial; background: #000 url("https://source.unsplash.com/collection/242611") no-repeat center; background-size: cover;}
body{position:relative; line-height: initial; background: #fff;}
a{color:#2196F3;}
ul,li{list-style: none;padding-left: .5rem; font-size: 1rem; margin:0;}

.header{ display: inline-block; position: fixed; top: 0; left:0; z-index: 9999; width:100%; background: #fff; border-bottom: 1px #ccc solid;}
.header::after{content=" "; clear:both;}
.title{text-align: center; padding: .25rem .5rem .25rem 1rem;}
.back{display: inline-block;width:1.5rem; height:1.5rem;}
.headline{display: inline-block; color:#2196F3;font-size: 2rem;line-height: 2.5rem;}
.headline span{text-transform:capitalize; font-size:1rem; color:#999;}

.main{
    max-width: 700px;
    margin: 4rem auto 1rem;
    padding: 1rem 2rem 3rem;
    border-radius: 1rem;
	text-align: center;
}
.main input{
	display:inline-block;
}


.fileUpload {
    position: relative;
	display: inline-block;
    overflow: hidden;
	cursor: pointer;
	max-width: 200px;
    margin: 20px 0;
    padding: 10px;
    background: #2196F3;
	color: #fff;
}

.fileUpload input[type="file"] {
    position: absolute;
	cursor: pointer;
    width: 100%; height: 100%;
    top: 0; bottom: 0; 
    left: 0; right: 0;
    opacity: 0;
    filter: alpha(opacity=0);
}


.main input[type="submit"] {
	display: none;
}
.main #Lsubmitimg{
	position: relative;
	display: inline-block;
    overflow: hidden;
	cursor: pointer;
	max-width: 200px;
	font-weight: 700;
    margin: 20px 0;
    padding: 10px;
    background: #2196F3;
	color: #fff;
    border: none;
}
.main #Lsubmitimg svg{
	position: relative;
	display: inline-block;
	vertical-align: bottom;
	height: 1.2rem;
}




</style>
</head><body id="body">

<?php // Header ?>
<?php $album = $_GET['a']; ?>
<div class="header">
	<div class="title">
		<a href="index.php?a=<?php echo $album; ?>" class="back" ><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><path fill="#aaa" d="M990 500c0-270.6-219.4-490-490-490S10 229.4 10 500s219.4 490 490 490 490-219.4 490-490zM536.7 267l63.3 63.3-173.3 173.3 188.7 188.7-63 63-252-252L536.7 267z"/></svg></a>
		<h1 class="headline">Upload<span id="albumname">~<?php echo $album; ?></span></h1>
	</div>
</div>
<?php // End-Header ?>
<?php // Backups ?>

<div class="main">
	<form method="post" action="fileupload.php?a=<?php echo $album; ?>" enctype="multipart/form-data">
		<div class="fileUpload">
			<span>Dateien auswählen</span>  
			<input type="file" id="filesToUpload" name="files[]" multiple="multiple" onchange="makeFileList();" accept="image/*" />
		</div>
		
		
		<ul id="fileList"></ul>
		<input type="submit" id="submitimg" value="Upload!" />
		<label id="Lsubmitimg" for="submitimg">
			<svg viewBox="0.328 0 512 526.05"><g fill="#fff"><path d="M482.84 308.1c-16.28 0-29.48 13.2-29.48 29.5v129.48H59.3v-129.5c0-16.28-13.2-29.48-29.48-29.48-16.3 0-29.5 13.2-29.5 29.5v158.96c0 16.3 13.2 29.5 29.5 29.5h453.02c16.3 0 29.5-13.2 29.5-29.5V337.6c0-16.3-13.2-29.5-29.5-29.5z"></path><path d="M235.47 8.65C241.01 3.11 248.51 0 256.33 0s15.3 3.1 20.84 8.64l118.9 118.9c11.52 11.5 11.52 30.1 0 41.6-11.5 11.52-30.18 11.52-41.7 0l-68.57-68.5v253.13c0 16.28-13.2 29.48-29.45 29.48-16.3 0-29.5-13.2-29.5-29.5V100.67l-68.54 68.56c-11.5 11.52-30.2 11.5-41.7 0-11.5-11.5-11.5-30.18 0-41.7l118.9-118.9z"></path></g></svg>
			Upload
		</label>
	</form>
	<!-- list Files to Upload -->
	<script type="text/javascript">function makeFileList(){for(var e=document.getElementById("filesToUpload"),i=document.getElementById("fileList");i.hasChildNodes();)i.removeChild(i.firstChild);for(var l=0;l<e.files.length;l++){var t=document.createElement("li");t.innerHTML=e.files[l].name,i.appendChild(t)}if(!i.hasChildNodes()){var t=document.createElement("li");t.innerHTML="No Files Selected",i.appendChild(t)}}makeFileList();</script>
</div>
<?php // End-Backups ?>
</body></html>