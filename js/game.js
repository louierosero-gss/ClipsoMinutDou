
$(function() {

	$(window).load(function() {
		gameContents('side');
	});

});


function gameContents(mode) {
	var val = '';
	if (mode=='quiz') {
		var select_quiz = $("input:radio[name='gameQuiz']:checked").val();
		if (select_quiz) {
			val += '&'+encodeURIComponent(select_quiz);
		} else {
			alert('選択肢から答えを選んでください。'); return false;
		}
	}
	$.ajax({
		url: "/mypage/game/?"+mode+val,
		beforeSend : function( xhr ){
			xhr.setRequestHeader("If-Modified-Since","Thu, 01 Jun 1970 00:00:00 GMT");
			//var token = $("meta[name='csrf-token']").attr('content');
			//xhr.setRequestHeader('X-CSRF-Token',token);
		},
		dataType: 'json'
	}).done(function(json,status,xhr){
		for(var i=0; i < json.length; i++){
			if (json[i].error) {
				alert(json[i].error); break;
			}
			if (json[i].id) {
				if (json[i].side && json[i].html) {
					$('#'+json[i].id).html(json[i].html);
					$('#'+json[i].id).show();
				} else if (json[i].recipe) {
					if (json[i].html) {
						var link = json[i].link;
						$.fancybox({
							content : json[i].html,
							padding : 0,
							showCloseButton : false,
							hideOnOverlayClick : false,
							scrolling : 'no',
							onComplete : function() {
								setTimeout(function(){
									$.fancybox.close(true);
									window.location.href = link;
								},1500);
							}
						});
					} else if (json[i].link) {
						window.location.href = json[i].link;
					}
				} else if (json[i].quiz) {
					if (json[i].side) {
						$('#'+json[i].id).html(json[i].html);
					} else if (json[i].html) {
						$.fancybox({
							content : json[i].html,
							padding : 0,
							hideOnContentClick : true,
							scrolling : 'no'
						});
					}
				} else if (json[i].cbanner) {
					if (json[i].side) {
						$('#'+json[i].id).html(json[i].html);
					} else if (json[i].html) {
						$.fancybox({
							content : json[i].html,
							padding : 0,
							scrolling : 'no'
						});
					}
				}
				if (json[i].totalpoint) {
					var totalpoint = json[i].totalpoint;
					$('#totalPoint span').text(totalpoint);
				}
				if (json[i].side_html) {
					var side_html = json[i].side_html;
					var id = json[i].id;
					setTimeout(function(){
						$('#'+id).html(side_html);
					},1000);
				}
			}
		}
	}).fail(function(xhr,status,error){
		if (error) { alert(error); }
		else { alert('An eleagal error occurred'); }
	});
	return false;
}

