function changeBackoundColor(){
	var color = $('#bcolor').val();
	$('#htmlContent').parent().css('background-color',color);
}
function changeFontColor(){
	var color = $('#txtcolor').val();
	$('#htmlContentMain').css('color',color);
}
function changeFontSize(){
	var fontSize = $('#fonttype').val();
	$('#htmlContentMain').css('font-size',fontSize);
}