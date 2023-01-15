jQuery( function( $ ){
    $( '#filter' ).submit(function(){
        var filter = $(this);
        $.ajax({
            url : true_obj.ajaxurl,
            data : filter.serialize(),
            type : 'POST',
            beforeSend : function( xhr ){
                filter.find( 'button' ).text( 'please wait...' );
            },
            success : function( data ){
                filter.find( 'button' ).text( 'apply' );
                $( '#response' ).remove();
                $( '#response' ).html(data);
            }
        });
        return false;
    });
});