function changeBackoundColor(){
	var color = $('#bcolor').val();
	$('#htmlContent').parent().css('background-color',color);
}
function changeFontColor(){
	var color = $('#txtcolor').val();
	$('#htmlContent').css('color',color);
}
function changeFontSize(){
	var fontSize = $('#fonttype').val();
	$('#htmlContent').css('font-size',fontSize);
}