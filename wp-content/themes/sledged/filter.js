jQuery(function($){
    $( document ).ready(function() {
        $('#filter').change(function(e){
            var filter = $('#filter');
            e.preventDefault();
            $('#response').html('');
            $.ajax({
                url:filter.attr('action'),
                data:filter.serialize(),
                type:filter.attr('method'),
                beforeSend:function(xhr){
                    filter.find('.infob').text('Please wait ...');
                },
                success:function(data){
                    $('#response').html(data);
                }
            });
            return false;
        });
    });
});
