var full = false;   
var fullE = undefined;
var gnav = document.getElementById("gallerynav");
var gpre = document.getElementById("galleryprev");
var gnex = document.getElementById("gallerynext");

var x = document.getElementsByClassName("imgwrap");
var i;
for (i = 0; i < x.length; i++) {
    x[i].onclick = function(e){
		fullE = this;
		this.classList.toggle("full");
		
		gnav.classList.toggle("hidden");
		full = !full;
		if(full){loadFull();}
	}
}

gpre.onclick = prevSlide;
gnex.onclick = nextSlide;

function prevSlide(){
	var pre = fullE.previousElementSibling;
	if(pre.id != "albumname"){
		stopvideo();
		fullE.classList.toggle("full");
		pre.classList.toggle("full");
		fullE = pre;
		loadFull();
	}else{ closeFull(); }
}
function nextSlide(){
	var nex = fullE.nextElementSibling;
	if(nex != undefined){
		stopvideo();
		fullE.classList.toggle("full");
		nex.classList.toggle("full");
		fullE = nex;
		loadFull();
	}else{ closeFull(); }
}
function closeFull(){
	stopvideo();
	gnav.classList.toggle("hidden");
	fullE.classList.toggle("full");
	full = !full;
	fullE = undefined;
}

//function isimg()	{return (document.getElementsByClassName('imgwrap image full')[0] != undefined);}
//function isvideo()	{return (document.getElementsByClassName('imgwrap video full')[0] != undefined);}
function isimg()	{return (fullE.className.indexOf("image") != -1);}
function isvideo()	{return (fullE.className.indexOf("video") != -1);;}
function stopvideo(){if(isvideo()){var video = fullE.getElementsByTagName('video')[0];video.pause();}}
//function playvideo(){if(isvideo()){var video = document.getElementsByClassName('imgwrap video full')[0].getElementsByTagName('video')[0];video.play();}}
function togglevideo(){	if(isvideo()){
		var video = fullE.getElementsByTagName('video')[0];
		if (video.paused == true){	video.play();
		}else{						video.pause();}
}}

function loadFull(){
	if(isimg()){
		var image = fullE.getElementsByTagName('img')[0];
		if((	image.getAttribute('src') == undefined)
			|| (image.getAttribute('src').indexOf(maxsize) == -1)){
			image.setAttribute('src', image.getAttribute('data-original').replace(minsize,maxsize));
			image.className += ' loaded';
		}
	}
	else if (isvideo()){
		var video = fullE.getElementsByTagName('video')[0];
		if(video.getAttribute('src') !== video.getAttribute('data-src')){
			video.setAttribute('src', video.getAttribute('data-src'));
			video.removeAttribute('poster');
			video.load();
			video.play();
		}else{
			video.play();
		}
	}
}

document.body.onkeydown=function(e){
  key=e.keyCode || e.charCode|| e.which; //cross browser complications
  if(key===27){	if(full){ closeFull();	} e.preventDefault();}
  if(key===32){	if(full){ togglevideo();} e.preventDefault();}
  if(key===37){	if(full){ prevSlide();	} e.preventDefault();}
  if(key===39){	if(full){ nextSlide();	} e.preventDefault();}
}