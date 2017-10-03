jQuery(function(){
	var $item = $('#tabBoxWrap .photo_wrap');

	var $tabbtn = $('.tab li');
	var $elment = $('.photo_wrap');

	$tabbtn.click(function(){
		$tabbtn.find('a.active img').attr('src', $tabbtn.find('a.active img').attr('src').replace('_on','_off'));
		$tabbtn.find('a').removeClass('active');
		$('.photo_wrap').removeClass('right');

		if($(this).attr('class').indexOf('all') != -1){
				$elment.css({display:'inline-block'});
		} else{
				var _class = '.' + $(this).attr('class');
				$elment.not(_class).hide();
				$('.photo_wrap' + _class).css({display:'inline-block'});
		}
		
		$(this).find('a').addClass('active');
		$(this).find('a img').attr('src', $(this).find('a img').attr('src').replace('_off','_on'));
	});	
});