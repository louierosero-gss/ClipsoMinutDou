/*
 * 	exCapsLock 0.1.0 - jQuery plugin
 *	written by Cyokodog	
 *
 *	Copyright (c) 2011 Cyokodog (http://d.hatena.ne.jp/cyokodog/)
 *	Dual licensed under the MIT (MIT-LICENSE.txt)
 *	and GPL (GPL-LICENSE.txt) licenses.
 *
 *	Built for jQuery library
 *	http://jquery.com
 *
 */
(function($){
	$.ex = $.ex || {};
	$.ex.capsLock = function(target,option){
		var o = this,
		c = o.config = $.extend({},$.ex.capsLock.defaults,option);
		c.target = target;
		c.target.bind('blur.ex-caps-lock',function(){
			o.capsLockOn();
		});
		o.capsLockOn();
		o.setImeMode();
	}
	$.extend($.ex.capsLock.prototype,{
		capsLockOn : function(){
			var o = this,c = o.config;
			if (c.capsLock) c.target.css('text-transform','uppercase').val(c.target.val().toUpperCase());
			return o;
		},
		setImeMode : function(imeMode){
			var o = this,c = o.config;
			c.target.css('ime-mode',imeMode || c.imeMode);
			return o;
		}
	});
	$.ex.capsLock.defaults = {
		api : false,
		capsLock : true,
		imeMode : 'auto'
	}
	$.fn.exCapsLock = function(option){
		var targets = this,apis = [];
		targets.each(function(idx){
			var target = targets.eq(idx);
			var api = target.data('ex-caps-lock') || new $.ex.capsLock(target,option);
			apis.push(api);
			target.data('ex-caps-lock',api);
		});
		return option && option.api ? $(apis) : targets;
	}
})(jQuery);

