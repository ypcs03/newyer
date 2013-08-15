$(document).ready(function(){
	$(".clProList").attr("isClicked","0");
	$(".clProList").click(function()
	{
		//alert($(this).attr("proId"));
		//alert($(this).parent().attr("id"));
		$.ajax
		({
			type:"get",
			url:$(this).parent().attr("id"),
			data:{proId:$(this).attr("proId")},
			beforeSend:function(XMLHttpRequest)
			{
	            //$('<div class="quick-alert">数据加载中，请稍后</div>')
	            //.insertAfter($("#btn_ajax"))
	            //.fadeIn('slow')
	            //.animate({opacity: 1.0}, 3000)
	            //.fadeOut('slow', function() {
	            //$(this).remove();
	            //});							
			},
			success:function(data, textStatus)
			{
				alert(data);		
			},
			complete:function(XMLHttpRequest, textStatus)
			{
				
			},
			error:function()
			{
				//alert("false");
			}
		});		
		$(".clProList").attr("isClicked","0");
		//alert($(this).attr("isClicked"));
		$(".clProList").removeClass("label-info");
		$(this).addClass("label-info");
		$(this).attr("isClicked","1");
		//alert($(this).attr("isClicked"));
	});
	
	$(".clProList").hover(function(){
		$(this).addClass("label-info");
	},
	function(){
		if($(this).attr("isClicked") === "0")
			$(this).removeClass("label-info");
		}
	);
});