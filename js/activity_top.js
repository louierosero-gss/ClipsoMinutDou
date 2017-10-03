$(function(){
	var $bubble = $('#mv li'),
	length = $bubble.length,
	count = 0,
	animeTimer,
	time = 3000,
	fadeTime = 400,
	pcFlg = true;

	/* animation */
	function bubbleShow(){
		clearTimeout(animeTimer);
		if(count != 0){
			{ $bubble.eq(count-1).fadeOut(fadeTime); }
			if(count === length){
				return;
			}else{
				$bubble.eq(count).fadeIn(fadeTime);
			}
		}else{
			$bubble.eq(count).fadeIn(fadeTime);
		};
		count++;
		animeTimer = setTimeout(function(){
			bubbleShow();
			},time);
	}
	
	jQuery.preloadImages = function(){
		for(var i = 0; i<arguments.length; i++){
			jQuery("<img>").attr("src", arguments[i]);
		}
	};
	$.preloadImages(
		"/images/products/CA/actifry/index/bubble01.gif",
		"/images/products/CA/actifry/index/bubble02.gif",
		"/images/products/CA/actifry/index/bubble03.gif",
		"/images/products/CA/actifry/index/bubble04.gif",
		"/images/products/CA/actifry/index/bubble05.gif",
		"/images/products/CA/actifry/index/bubble06.gif",
		"/images/products/CA/actifry/index/bubble07.gif",
		"/images/products/CA/actifry/index/bubble08.gif",
		"/images/products/CA/actifry/index/bubble09.gif",
		"/images/products/CA/actifry/index/bubble10.gif",
		"/images/products/CA/actifry/index/bubble11.gif",
		"/images/products/CA/actifry/index/bubble12.gif"
		);

	function widthChk(){
		if($('html').width() <= 640){
			pcFlg = false;
			}
		else{
			pcFlg = true;
			}
	}
	
	/* load */	
	jQuery.event.add(window,"load",function() {
		widthChk();
		if(pcFlg){
			animeTimer = setTimeout(function(){
				bubbleShow();},10);
		}
	});


	/* fixed処理 */
	var stimer = null,
			_target = 600;

	$(window).on('scroll',function() {
		if(pcFlg){
			clearTimeout(stimer);
			stimer = setTimeout(function() {
				_sctop = $(this).scrollTop();
				if(_sctop > _target){
					clearTimeout(animeTimer);
					$bubble.stop(true,true).fadeOut(fadeTime);
				}
			}, 10);
		}
	});	
});