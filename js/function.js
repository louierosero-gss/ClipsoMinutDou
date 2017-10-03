jQuery(function(){
	
	var pfFlg = true,
			$acordionBtn = $('.box_detail h3');

	$acordionBtn.click(function(){
		if(!pcFlg){
			$(this).next('p').toggle();

			if($(this).next('p').css('display')==='block'){
				$(this).find('img.sp').attr('src', $(this).find('img.sp').attr('src').replace('_def','_ac'));
			}else{
				$(this).find('img.sp').attr('src', $(this).find('img.sp').attr('src').replace('_ac','_def'));
			}
		}else{
			return;
		}
	});

	function widthChk(){
		if($('html').width() <= 640){
			pcFlg = false;
			}
		else{
			pcFlg = true;
			}
	}

	jQuery.preloadImages = function(){
		for(var i = 0; i<arguments.length; i++){
			jQuery("<img>").attr("src", arguments[i]);
		}
	};
	$.preloadImages(
		"/images/products/CA/actifry/function/ttl_function_01_ac.png",
		"/images/products/CA/actifry/function/ttl_function_02_ac.png",
		"/images/products/CA/actifry/function/ttl_function_03_ac.png",
		"/images/products/CA/actifry/function/ttl_function_04_ac.png"
		);

	/* load */	
	jQuery.event.add(window,"load",function() {
		widthChk();
	});

});