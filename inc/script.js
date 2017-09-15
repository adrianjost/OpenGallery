var full = false;  
// Toggle Fullscreen of Images
$(".imgwrap").click(function(){
	
	$(this).toggleClass('full');
	$(".gallerynav").toggleClass('hidden');
	full = !full;
	loadFull();
});

// Fullscreen Navigation
$(".galleryprev").click(prevSlide);
$(".gallerynext").click(nextSlide);


function prevSlide(){
	stopvideo();
	if($(".imgwrap.full").prev().prev().length != 0){
		$(".imgwrap.full").toggleClass('close');
		$(".imgwrap.close").prev().toggleClass('full');
		$(".imgwrap.close").toggleClass('close').toggleClass('full');
		loadFull();
	}else{ closeFull(); }
}
function nextSlide(){
	stopvideo();
	if($(".imgwrap.full").next().length != 0){	
		$(".imgwrap.full").toggleClass('close');
		$(".imgwrap.close").next().toggleClass('full');
		$(".imgwrap.close").toggleClass('close').toggleClass('full');
		loadFull();
	}else{ closeFull(); }
}
function closeFull(){
	$(".gallerynav").toggleClass('hidden');
	$(".imgwrap.full").toggleClass('full');
	stopvideo();
	full = !full;
}


function isimg()	{return ($('.imgwrap.image.full').length != 0);}
function isvideo()	{return ($('.imgwrap.video.full').length != 0);}
function stopvideo(){if(isvideo()){var video = $('.imgwrap.video.full > .lazyvid').get(0);video.pause();}}
function playvideo(){if(isvideo()){var video = $('.imgwrap.video.full > .lazyvid').get(0);video.play();}}
function togglevideo(){	if(isvideo()){
		var video = $('.imgwrap.video.full > .lazyvid').get(0);
		if (video.paused == true){	video.play();
		}else{						video.pause();}
}}

function loadFull(){
	if(isimg()){
		if($('.imgwrap.image.full > img').attr('src').indexOf("data:image/gif;") !== -1){
			var image = $('.imgwrap.image.full > img');
			image.attr('src', image.attr('data-original').replace('?r=','?no='));
		}
		if($('.imgwrap.image.full > img').attr('src').indexOf("?r=") !== -1){
			var image = $('.imgwrap.image.full > img');
			image.attr('src', image.attr('data-original').replace('?r=150','').replace('?r=300',''));
		}
	}
	else if (isvideo()){
		if($('.imgwrap.video.full > .lazyvid').attr('src') !== $('.imgwrap.video.full > .lazyvid').attr('data-src')){
			var video = $('.imgwrap.video.full > .lazyvid');
			video.attr('src', video.attr('data-src'));
			video.removeAttr('poster');
			video.get(0).load();
			video.get(0).play();
		}else{
			playvideo();
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
