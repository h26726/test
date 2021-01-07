
$(document).ready(function () {
	// easypiechart----------
	var $this = $('.easypiechart');
	$data = $this.data();

	$('.easypiechart').easyPieChart($data);
	// $('.easypiechart').removeAttr('style');
	// $('.easypiechart canvas').removeAttr('style');

    // if(SYS_FUNCTION == 'Logout'){
	// 	$("#timer").hide();
	// }
	// else{
	// 	OnSecond();
	// 	GetUnSignList();
	// }
	$(".easypiechart").click(function(){
		Operate();
	});

	var open = false;
	$("#sidebar-btn").click(function(){
		$('.collapse_nav').collapse('hide');
		if(open)
		{
			$(".sildebar").animate({left:-200});
			open = false;
		}
		else
		{
			$(".sildebar").animate({left:0});
			open = true;
		}
	})

	$(".backTop").click(function(){
		$('html,body').animate({scrollTop:0}, 333);
	})
	$(window).scroll(function() {
		$('.backTop').css('visibility','visible');
		if ( $(this).scrollTop() > 0 ){
			$('.backTop').fadeIn();
		} else {
			$('.backTop').fadeOut();
		}
	})
	// -------------------------
});
// easypiechart----------
var timercountEnd = 180;
var timercount = 0;
var restart = false;

function Operate(){
	restart = true;
	$.ajax({
		type: 'POST',
		data: {'test':restart},
		success: function(){
			//$('.easypiechart').html("abbaa");
		},
		error:function(xhr) {
			//console.log(xhr);
		}
	})
}

function SetPieValue(value){
	$('.easypiechart').data('easyPieChart').update(100 - value);
}

function SetPieColor(time){
	if(time >= 150 && time < 170)
	{

		color = "#ff8000";
		setTimeout("disable()",500);
		setTimeout("enable()",1000);
	}
	else if(time >=170)
	{
		color = "#ff2d2d";
		setTimeout("disable()",250);
		setTimeout("enable()",500);
		setTimeout("disable()",750);
		setTimeout("enable()",1000);
	}
	else{
		color = "#4cc0c1";
	}
	$('.easypiechart').data('easyPieChart').options['barColor'] = color;
	$('#t1').css("color",color);

}

function disable()
{
	document.getElementById("t1").style.visibility="hidden";
}

function enable()
{
	document.getElementById("t1").style.visibility="visible";
}

function OnSecond(){
	if(timercount>=timercountEnd){
		timercount = 0;
		if(!SYS_ENV)
		{
			Link("Logout");
			return;
		}

	}
	else if(restart == true) timercount = 0;
	else
		timercount++;
	restart = false;
	var vvv = (timercount/timercountEnd)*100;
	SetPieValue(vvv);
	SetPieColor(timercount);
	$("#t1").text(timercountEnd-timercount);
	setTimeout("OnSecond()",1000);
}
//unSign-----------------------
function GetUnSignList()
{
	$.post('Help',{},Hander,'json');
}
function Hander(d)
{
	var e = $("#remind");
	e.empty();
	if(d['ErrorCode'])
	{
		e.css('color','');
	}
	else
	{
		var element = document.getElementById("remind");
   		element.classList.add("bell-link");
		//e.css('border','2px solid #ecee6f');
		// e.append('<i class="fas fa-bell" style="font-size: 14px;color:yellow;" id="bell"></i>')
		var data = d['Data'];
		for(var key in data){
				// console.log(key);
			e.append('<a class="dropdown-item" href="'+key+'">'+data[key][0]+'('+data[key][1]+')</a>');
		}

	}
	setTimeout("GetUnSignList()",5000);
}
// -----------------------
function Link(url)
{
	document.location.href = url;
}
