$(function(){
	$('#button_register').bind('click',function(){
		var email=$('#email').val();
		var phone=$('#phone').val();
		var birthday=$('#birthday').val();
		if(valid.checkValidEmail(email) && valid.checkValidPhoneNumber(phone) && valid.checkValidDate(birthday)){
			//alert('ok');
			$('#form_register').submit();
		}
	});
	
	$('#login_popup').bind('click',function(){
		
	});
	
	$('#birthday').datepicker({
		dateFormat:'yy-mm-dd',
		weekHeader: 'Week',
		showWeek: true,
		changeMonth: true , 
		changeYear: true,
		isRTL: false,
		showMonthAfterYear: false,
		currentText: 'Today'
	});
});