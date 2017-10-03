$.fn.addlink = function(baseURL){
    var dict = ["スティックミキサー","http://www.stickmixer.t-fal.co.jp/" ];
    return this.each(function(){
        var srcText = this.innerHTML;
        for (var i=0; i<dict.length; i+=2){
            srcText = srcText.replace(new RegExp(dict[i]),'<a href="'+dict[i+1]+'" target="_blank">'+dict[i]+"</a>");
        }
        this.innerHTML = srcText;
    });
}

$.fn.addColor = function(baseURL){
	var dict = ["&lt;b&gt;", "<em>",
    	"&lt;/b&gt;", "</em>"];
    return this.each(function(){
    	var srcText = this.innerHTML;
    	for (var i=0; i<dict.length; i+=2){
    		srcText = srcText.split(dict[i]).join(dict[i+1]);
    	}
    	this.innerHTML = srcText;
    });
}

$(function(){
    var url = location.href.split('/');
    if(url[url.length-1] == ''){
        url.pop();
    }
    if(parseInt(url[url.length-1]) > 1016 && parseInt(url[url.length-1]) < 1099
    || parseInt(url[url.length-1]) > 1231 && parseInt(url[url.length-1]) < 1244
    || parseInt(url[url.length-1]) > 1245 && parseInt(url[url.length-1]) < 1256 ){
        $('li.r_time').append('<br /><span class="red">※調理時間は予熱時間を含めません</span>');
    }
});


