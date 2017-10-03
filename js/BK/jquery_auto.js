//画像を透明化させる
jQuery.TransOver = function() {
	jQuery(document).ready(function(){
		jQuery("img.Tover").fadeTo(0,1.0);
		jQuery("img.Tover").hover(function(){
			jQuery(this).fadeTo(100,0.72);
		},
			function(){
				jQuery(this).fadeTo(100,1.0);
			}
		);
	});
}
jQuery(function(){
	jQuery.TransOver();
});

//画像置換
jQuery(document).ready(function($) {
	var postfix = '_over';
	$('.Hover').not('[src*="'+ postfix +'."]').each(function() {
		var img = $(this);
		var src = img.attr('src');
		var src_on = src.substr(0, src.lastIndexOf('.'))
		           + postfix
		           + src.substring(src.lastIndexOf('.'));
		$('<img>').attr('src', src_on);
		img.hover(
			function() {
				img.attr('src', src_on);
			},
			function() {
				img.attr('src', src);
			}
		);
	});
});


//blockリンク
/*
$BlockTransOver = function() {
	$(".blockLink a").css("display","block");
	$(document).ready(function(){
		$(".blockLink a").hover(function(){
			$("img",this).fadeTo(100,0.72);
		},
			function(){
				$("img",this).fadeTo(100,1.0);
			}
		);
	});
}
jQuery(function(){
	$BlockTransOver();
});
*/
$BlockTransOver = function() {
	$(".blockLink").css("display","block");
	$(".blockLink").css("cursor","pointer");
	$(document).ready(function(){
		$(".blockLink").hover(function(){
			$(this).fadeTo(100,0.72);
		},
			function(){
				$(this).fadeTo(100,1.0);
			}
		);
	});
}
jQuery(function(){
	$BlockTransOver();
});
