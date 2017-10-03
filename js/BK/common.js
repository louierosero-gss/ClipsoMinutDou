$(function() {
	if($(window).width() <= 640 && document.getElementById("sp_global_login_area") != null){
        $("#sp_global_login_area").load("/inc/login_header.php?sp=on");
    }else if(document.getElementById("global_menu") !== null){
        $("#global_menu ul").load("/inc/login_header.php");
    }else if(document.getElementById("subNav") !== null){
	    $("#subNav ul").load("/inc/login_header.php");
    }
	
	
	$("#footer_products").load("/inc/footer_products.html");
	$("#products_banner").load("/inc/banner.php?type=4");
	$("#products_all_banner").load("/inc/banner.php?type=7");
	$("#side .banner").load("/inc/banner.php?type=6");
	$("#side .library").load("/inc/banner.php?type=3");
	$("#banner_top_up").load("/inc/banner.php?type=1");
	$("#banarArea.top_under").load("/inc/banner.php?type=2");
	$("#side .recipe_feature").load("/inc/banner.php?type=5");
	$("#mypage_banner").load("/inc/banner.php?type=8");
	$("#footer").load("/inc/footer.html");
    $("#side .recipe_pickup").load("/inc/side_top_recipe.php");
    $("#pickup .pickup_area").load("/inc/pickup_recipe.php");
    $("#side .recipe_new dl").load("/inc/recommend_recipe.php");
    $("#side .recipe_search .search_area ul").load("/inc/recipe_keyword.php");
    $("#freeword .search_area dl").load("/inc/recipe_keyword.php?disp=search");
    $("#recipe .search_area ul#popular_keyword").load("/inc/recipe_keyword.php");
    $("#ftCW-bnr").load("/inc/banner.php?type=9");
    $("#ftCA-bnr").load("/inc/banner.php?type=10");
    $("#ftCE-bnr").load("/inc/banner.php?type=11");
    $(".ftProTop").load("/inc/products_link.html");
    $(".ftProList").load("/inc/products_cs.html");
    $("#sp-banner-list").load("/inc/banner.php?type=6");
});

$(window).load(function(){
	$("#pressTop div").load("/inc/top_press.php");
    $("#top #mainimage").load("/inc/header_image.php");
    $("#topLeftArea .pickRecipeBox").load("/inc/top_recipe.php");
    
    //for responsive - mobile
	if(document.getElementById("rp_sideMenu") !== null){
		//viewport
		var deviceW = screen.width;
		if(deviceW > 767 && document.getElementsByName('viewport').length) {
			document.getElementsByName('viewport')[0].setAttribute('content', 'width=1000,initial-scale=1');
		}
		//slide menu
		var $btn_menuswitch = $(".btn_menuswitch");
		var $rp_sideMenu = $("#rp_sideMenu");
	    $("#subNav ul li.disp_on").clone().appendTo($("#rp_sideMenu ul.menu_login"));
		$btn_menuswitch.click(function(){
			$(this).toggleClass("open");
			$rp_sideMenu.slideToggle("normal", function(){
				$rp_sideMenu.css({display: ''});
			}).toggleClass("open");
		});
    }
});


/*!
 * 
 * rollover
 * 
 */
$(function(){
$("img.Tover").fadeTo(0,1.0, function(){
			$(this).css({display: ''});
		});
$("img.Tover").hover(function(){
		$(this).fadeTo(100,0.72, function(){
			$(this).css({display: ''});
		});
	},
		function(){
			$(this).fadeTo(100,1.0, function(){
			$(this).css({display: ''});
		});
	}
	);
});
$(function($) {
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
$(function(){
	$(".blockLink").css("display","block").css("cursor","pointer");
	$(".blockLink").hover(function(){
		$(this).fadeTo(100,0.72);
	},
		function(){
			$(this).fadeTo(100,1.0);
		}
	);
});
/*!
 * 
 * scroll
 * 
 
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
});
*/	

/* GA */

  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-21465702-3', 't-fal.co.jp');
  ga('require', 'displayfeatures');
  ga('send', 'pageview');

$(function(){
    $('a').click(function(e){
        ga('send','event','clubt-fal', $(location).attr('href'), $(this).attr('href'));
    });
});


/* Piwik */

  var _paq = _paq || [];
  _paq.push(["setDocumentTitle", document.domain + "/" + document.title]);
  _paq.push(["setDomains", ["*.www.club.t-fal.co.jp"]]);
  _paq.push(["trackPageView"]);
  _paq.push(["enableLinkTracking"]);

  (function() {
    var u=(("https:" == document.location.protocol) ? "https" : "http") + "://133.242.44.169/piwik/";
    _paq.push(["setTrackerUrl", u+"piwik.php"]);
    _paq.push(["setSiteId", "1"]);
    var d=document, g=d.createElement("script"), s=d.getElementsByTagName("script")[0]; g.type="text/javascript";
    g.defer=true; g.async=true; g.src=u+"piwik.js"; s.parentNode.insertBefore(g,s);
  })();