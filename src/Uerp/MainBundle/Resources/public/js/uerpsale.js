
var delay = (function(){
  var timer = 0;
  return function(callback, ms){
    clearTimeout (timer);
    timer = setTimeout(callback, ms);
  };
})();






function findproduct(){

	var cod = $("#inputCod").val();

	if(cod.replace(/\s/g,"") != ""){

		var crandon = Math.floor((Math.random() * 100) + 1);
		$('#loading-indicator').append('<img  id="'+crandon+ '" src="http://www.ajaxload.info/images/exemples/21.gif">');
		$("#codd").removeClass("has-error");
		$("#inputsetcod").val("");
		
		var jqxhr = $.post( findproducturl ,{ cod: cod } , function(cod) { })
	  		.done(function(dados) {
				$("#descp").html(dados.desc);
				$("#inputSetpc").val(dados.cprice);
				$("#inputsetcod").val(dados.cod);
				$("#inputPrice").val(dados.price);
				$("#codd").removeClass("has-error");})
	  		.fail(function() {
				$("#codd").addClass("has-error");
				$("#inputcod").val(" ");
				})
	  		.always(function() {
				var element = document.getElementById(crandon);
				$( "#"+crandon).remove();
				delete element;});
	}
}
function additem () {
	var cod = $("#inputsetcod").val();

	if(cod.replace(/\s/g,"") != ""){

  	
        cod = cod.replace(/\s/g,'');
		var saleid = $("#inputSaleid").val();
	  	var qtd = parseFloat($('#inputQtd').val().replace(",","."));
	  	var price = parseFloat($('#inputPrice').val().replace(",","."));
	  	var cprice =parseFloat($('#inputSetpc').val().replace(",","."));
		var crandon = Math.floor((Math.random() * 100) + 1);
		$('#addingitem').append('<img  id="'+crandon+ '" src="http://www.ajaxload.info/images/exemples/21.gif">');
		var jqxhr = $.post( saleitems_additemurl ,{ cod: cod, saleid : saleid , qtd : qtd, price : price, cprice : cprice } , function(cod) { })
  			.done(function(dados) {
		  		console.log("adicionado item id =>"+dados.id);
		  		// console.log(dados.id);	
		  		 refreshsaledata();
		  		 refreshsaleitems();
		  		 $("#inputsetcod").val(" ");
		  		 $("#inputQtd").val("1");
		  		 $("#inputPrice").val(" ");
		  		 $("#inputCod").val("");
		  		 $("#inputSetpc").val(" ");
		  		 $("#descp").html("");})
	  		.fail(function() {
				// $("#codd").addClass("has-error");
				})
	  		.always(function() {
				var element = document.getElementById(crandon);
				$( "#"+crandon).remove();
				delete element;})
	  		 $("#inputCod").val(" ");;
	}
       
}
function refreshsaledata () {

	var crandon = Math.floor((Math.random() * 100) + 1);
	$('#saleld').append('<img  id="'+crandon+ '" src="http://www.ajaxload.info/images/exemples/21.gif">');

				  var saleid = $("#inputSaleid").val(); 
	$.post( sale_reloadmenuurl ,  { id : saleid }, function( data ) {
$( "#supmenu" ).html( data );
// alert( "Load was performed." );
}).always(function(){
			var element = document.getElementById(crandon);
			$( "#"+crandon).remove();
			delete element;});

}


function refreshsaleitems(){
//listsaleitems

var crandon = Math.floor((Math.random() * 100) + 1);
	$('#saleitemsld').append('<img  id="'+crandon+ '" src="http://www.ajaxload.info/images/exemples/21.gif">');

				  var saleid = $("#inputSaleid").val(); 
	$.post( listsaleitemsurl,  { id : saleid }, function( data ) {
$( "#tableitems" ).html( data );
// alert( "Load was performed." );
}).always(function(){
			var element = document.getElementById(crandon);
			$( "#"+crandon).remove();
			delete element;});



}
function deleteproduto (id) {
	
var crandon = Math.floor((Math.random() * 100) + 1);
	$('#saleitemsld').append('<img  id="'+crandon+ '" src="http://www.ajaxload.info/images/exemples/21.gif">');

			
	$.post( saleitems_removeurl,  { itemid : id }, function( data ) {
// $( "#tableitems" ).html( data );
// alert( "Load was performed. "+ data );
}).done(function () {
			  		 refreshsaledata();
		  		 refreshsaleitems();
}).always(function(){
			var element = document.getElementById(crandon);
			$( "#"+crandon).remove();
			delete element;
	 refreshsaledata();
		  		 refreshsaleitems();
			});


}