$(document).ready(function() {
    $(document).on('click', '.btn-search', function() {
        var form = $('#search-form');
        console.log(form);
        var url = location.href + '/search';
        console.log(url);
        $.ajax({
            method: 'GET',
            url: location.href + '/search',
            data: form.serialize(),
            success: function(res) {
                console.log(res);
                
            }
        });
    });
});