$(function() {
　$('a[href*=#]').click(function() {
　　　if (location.pathname.replace(/^\//,'') ==
this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
　　　var target = $(this.hash);
　　　target = target.length && target;
　　　if (target.length) {
　　　　var sclpos = 30;
　　　　var scldurat = 1000;
　　　　var targetOffset = target.offset().top - sclpos;
　　　　$('html,body')
　　　　.animate({scrollTop: targetOffset}, 'slow');
　　　　return false;
　　　　}
　　　}
　});

	
	//last-child
	$("#side_content li:last-child").addClass("lastchild");
	$("#side_content li:last-child").addClass("lastchild");
});

