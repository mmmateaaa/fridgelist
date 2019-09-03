$(document).ready( function(){

	//ajax search products
    $('#productSearch').autocomplete({
        focus: function(event, ui){
            event.preventDefault();
        },
	    source: function( request, response ){
    		$.ajax({
    			method: 'POST',
    			url: myUrl + 'products/search',
    			data: {
    					'string': request.term
    				},
    			dataType: 'json'
    		}).done( function(data){
    			console.log('success');
                response( data.results );

    		}).fail( function(data){
    			console.log('fail');
    			console.log(myUrl);
    		});
        },
        appendTo: 'body',
        messages: {
            noResults: '',
            results: function() {}
        },
        select: function( event, ui ){
        	$('#selectedProducts').append('<p>' + ui.item.name + ': ' + ui.item.quantity + '</p>')
        }
    }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
        
         return $( "<li class='li-auto'></li>" ).data("item.autocomplete", item)
            .append( "<a href='#'>" + item.name + "</span></a>" )
            .appendTo( ul );   
    };

    $('')
});