function viewRecipes(data,mode,year,month,date,type){
	//alert(page);
	$('#view_my').empty();
    
	data = encodeURIComponent(data);
    var url = '/js/view_recipe.php';
    var today = new Date();
    var y = today.getYear();
    y = (y < 2000) ? y + 1900 : y ;
    var m = today.getMonth() + 1;
    if (m < 10) { m = "0" + m; }
    var d = today.getDate();
    if (d < 10) { d = "0" + d; }
    
    if(data == null || data == ""){
    	 throw 'No Archive';
    }
    
    if(mode == "calendar"){
        if((year != null && year != "") && (month != null && month != "")){
        	url = url + '?enc=' + data+ '&view=' + mode + '&year=' + year + '&month=' + month;
        } else {
        	url = url + '?enc=' + data+ '&view=' + mode + '&year=' + y + '&month=' + m;
        }
    } else if(mode == "fav_detail"){
    	if((year != null && year != "") && (month != null && month != "") && (date != null && date != "")){
    		url = url + '?enc=' + data+ '&view=' + mode + '&year=' + year + '&month=' + month + '&date=' + date;
    	} else {
    		url = url + '?enc=' + data+ '&view=' + mode + '&year=' + y + '&month=' + m + '&date=' + d;
        }
    } else if(mode == "notification"){
    	if((year != null && year != "") && (month != null && month != "") && (date != null && date != "")){
    		url = url + '?enc=' + data+ '&view=' + mode + '&year=' + year + '&month=' + month + '&date=' + date;
    	} else {
    		url = url + '?enc=' + data+ '&view=' + mode + '&year=' + y + '&month=' + m + '&date=' + d;
        }
    } else if(mode == "log"){
    	if(type == "recipe"){
    		url = url + '?enc=' + data+ '&view=' + mode + '&type=' + type;
    	} else if(type == "keyword"){
    		url = url + '?enc=' + data+ '&view=' + mode + '&type=' + type;
        }
    } else {
    	url = url + '?enc=' + data;
    }
    
    
    //alert(url);
    $.ajax({
    	type: 'GET',
    	url: url,
    	dataType: 'html',
    	cache: false,
    	success: function(ddd){
    		//$('#view_my').empty();
    		$('#view_my').append(ddd);
    		//alert(data);
    		
    		//$(data).appendTo("#view_my").hide().fadeIn(1000);
        },
        error:function(){
        	alert('An eleagal error occurred');
        }
    });

}

function deleteRecipe(data,id, title){
	
		var url = '/js/view_recipe.php';
		
		$.confirm({
			'title'		: 'お気に入り削除',
			'message'	: 'レシピ：'+title+'をお気に入りから削除しますか？',
			'buttons'	: {
				'削除する'	: {
					'class'	: 'blue',
					'action': function(){
						$.ajax({
							type: 'POST',
						  	url: url,
						  	cache: false,
						  	data: "enc="+ encodeURIComponent(data) + "&id=" + id
					    }).done(function(){
					    	viewRecipes(data);
					    }).fail(function(){
					    	alert('An eleagal error occurred');
					    });
					}
				},
				'しない'	: {
					'class'	: 'gray',
					'action': function(){}	// Nothing to do in this case. You can as well omit the action property.
				}
			}
		});
		

	/*if(!confirm('レシピ：'+title+'をお気に入りから削除しますか？')){
		return false;
    }
	var url = '/js/view_recipe.php';
	
	$.ajax({
    	type: 'POST',
    	url: url,
    	cache: false,
    	data: "enc="+ data + "&id=" + id
    }).done(function(){
    	viewRecipes(data);
    }).fail(function(){
    	alert('An eleagal error occurred');
    });*/
}