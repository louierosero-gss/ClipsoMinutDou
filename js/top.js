$(function(){
	$("#feature").tabs({
	fx:{opacity: "toggle",duration:"fast"},
	event: "mouseover"
	})
	.tabs("rotate", 5000, false);
});
