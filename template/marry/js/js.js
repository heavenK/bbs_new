
var jq = jQuery.noConflict(); 

function a(x,y){
	l = jq('.box').offset().left;
	w = jq('.box').width();
	jq('#tbox').css('left',(l + w + x) + 'px');
	jq('#tbox').css('bottom',y + 'px');
}
function b(){
	h = jq(window).height();
	t = jq(document).scrollTop();
	if(t > h){
		jq('#gotop').fadeIn('slow');
	}else{
		jq('#gotop').fadeOut('slow');
	}
}
jq(document).ready(function(e) {		
	a(10,10);//#tbox的div距浏览器底部和页面内容区域右侧的距离
	b();
	jq('#gotop').click(function(){
		jq(document).scrollTop(0);	
	})
});
jq(window).resize(function(){
	a(10,10);//#tbox的div距浏览器底部和页面内容区域右侧的距离
});

jq(window).scroll(function(e){
	b();		
})
