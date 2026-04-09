 $(document).ready(function() {

$("ul#nav > li").each(function(index) {  
							   
							   
							   if($(this).hasClass("currentpage"))
							   {
   									

									$(this).addClass("hover_parent");
	
									var child = $('#' +this.id+' > a span');
									child.addClass("link1");
							   }
							   
							
							   }  );


 
 $(".here").hover(function(){  

var ch = $(this).parent();
var pa = this.parentNode.id;
//alert(this.parentNode.id);
var child = ch.children();



ch.addClass("hover_parent");

var child = $('#' +pa+' > a span');
child.addClass("link1");
$(".text1").addClass("link1");



},function(){

var ch = $(this).parent();

var child = ch.children();




$(".link1").each(function(index){ 
						  var par = $(this).parent();
						  
						  if(!$(par).parent().hasClass("currentpage"))
						  {
							  ch.removeClass("hover_parent");
							  	$(this).removeClass("link1");
						  }
						  
						  });


 } );





 });
