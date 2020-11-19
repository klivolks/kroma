// JavaScript Document
$(function(){
	var yesterday = new Date((new Date()).valueOf()-1000*60*60*24);
	$('.datepicker').pickadate({
	disable: [
    	{ from: [0,0,0], to: yesterday }
  	],
    selectMonths: true,
    selectYears: 15, 
    today: 'Today',
    clear: 'Clear',
    close: 'Ok',
    closeOnSelect: false
  });
	var yesterday = new Date((new Date()).valueOf()-1000*60*60*24);
	$('.dob').pickadate({
    selectMonths: true,
    selectYears: 15, 
    today: 'Today',
    clear: 'Clear',
    close: 'Ok',
    closeOnSelect: false
  });
	$('.materialboxed').materialbox();
	$('body').css('display', 'none');
	$('body').fadeIn(200);
	$('a').click(function(e) {
		e.preventDefault();
		newLocation = this.href;
		var currentLocation =window.location.href+"#";
		if(newLocation!=currentLocation){
			$('body').fadeOut(200, newpage);
		}
	});
	if ((/iphone|ipod|ipad.*os 5/gi).test(navigator.appVersion)) {
		window.onpageshow = function(evt) {
			if (evt.persisted) {
				document.body.style.display = "none";
				location.reload();
			}
		};
	}
	$('select').material_select();
});
function prev_slide(){ 
	$('.trending-wrap').multislider('prev'); 
}
function next_slide(){ 
	$('.trending-wrap').multislider('next'); 
}
function newpage() {
window.location = newLocation;
}
function Reload() {
	try {
		var headElement = document.getElementsByTagName("head")[0];
		if (headElement && headElement.innerHTML)
		headElement.innerHTML += "<meta http-equiv=\"refresh\" content=\"1\">";
	}
	catch (e) {}
}
function socialMediaLogin(){
	ocalogin(function(response){
		var profile = response.profile[0];
		var email = response.email[0].email;
		var mobile = response.mobile[0].mobile;
		$("#FullName").focus();
		$("#FullName").val(profile.fname+" "+profile.lname);
		$("#Gender").val(profile.gender);
		$('select').material_select();
		$("#Email").val(email);
		$("#Phone").val(mobile);
		$("#klubstaId").val(response.user_id);
		$("#Email").focus();
		$("#Phone").focus();
		$("#Password").focus();
	});
}
function Klubstasignin(){
	ocalogin(function(response){
		$.ajax({
			url:"/functions/klubsta-signin/",
			method:"post",
			type:"post",
			data:{
				klubstaId : response.user_id
			},
			success:function(data){
				if(data==='error'){
					window.location.assign('/register/?msg=notregistered');
				}
				else{
					window.location.assign('/');
				}
			}
		});
	});
}
function add_price(price){
	$("#price").vale(price);
}
function verify_input(field){
	if($("#"+field).val()==''){
		if(field=='dateOfBooking'){
			$("#msg").html('<div class="card card-panel red white-text">Select date of booking to continue</div>');
		}
		if(field=='check_in'){
			$("#msg").html('<div class="card card-panel red white-text">Select check in and check out dates to continue</div>');
		}
		return false;
		
	}
	else{
		return true;
	}
}
function activate_tab(n){
	$("#tab-1").hide();
	$("#tab-2").hide();
	$("#tab-3").hide();
	$("#tab-"+n).show(500);
	$(".icon").removeClass('active');
	$("#icon-"+n).addClass('active');
} 