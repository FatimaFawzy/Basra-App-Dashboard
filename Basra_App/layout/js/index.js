$(function(){
'use strict';
$('.layout').height($(window).height());
var width = $('.sidebar-wrapper').width();
var height=$('.navbar').height();

$('.navbar').css('left',width);
$('.auto-margin').css('margin-left',width);
$('body').css('padding-top',height);
$('.auto-margin').css('margin-top',(height*0.5));

	$('.Ar_navbar').css('right',width);
	$('.Ar_auto-margin').css({
		'margin-right':width,
		'margin-left':0
	});


//Login

$('.lg-form button ').hover(function(){
$('.over-login').css('display','block');
$(this).find('.first').animate({

	height:'100%'

},500)
},function(){
$('.over-login').css('display','none');
$(this).find('.first').animate({

	height:'0'

},400);
//$('.over-add a').css('display','none');
});

//product
$('.add').hover(function(){
$('.over-add i').css('display','block');
$(this).css('color','#e55507')
$(this).find('.over-add').animate({

	width:($('.add').innerWidth())
},500)
},function(){

$(this).find('.over-add').animate({

	width:'0'

},500);
$('.over-add i').css('display','none');
});
//    password
$('.fa-eye').click(function(){
$('.lg-form input[type="password"]').attr('type','text');
$('.fa-eye-slash').css('display','block');
$(this).css('display','none');
});

$('.fa-eye-slash').click(function(){
$('.lg-form  .password input[type="text"]').attr('type','password');
$('.fa-eye').css('display','block');
$(this).css('display','none');
});
$('.lg-form  .password input[type="password"]').focus(function(){

$('.lg-form  .password .fa-eye').show();

});

// add merchants
$('.add_ok').on('click',function(){
$('.success').remove();
});




// EN & AR
$('.lang').click(function(){
var link=$('.link').text();
$(this).attr('href',link);
$('.form button').click();

});
//close secondery modal
$('.modal .delet-req-close').on('click' ,function() {
 	$('.modal-dismiss').modal('hide');
});

// predent
$('.discount').on('input',function() {
	$('.dis-prec').show();
	var val=$(this).val();
if(val=="")
{
	$('.dis-prec').hide();
}
});
$( " .ZainCash" ).change(function() {
if(this.checked){
		$(".paid-way").show();
	}
	else
	{
		 $(".paid-way").hide();
	}
});

$( " .CashPayed" ).change(function() {
if(this.checked){
		$(".paid-way").hide();
	}
});





});
