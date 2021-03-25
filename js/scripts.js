jQuery(document).ready(function($){
    let form = $('#crowd_importer_form');

    if(form.length)
    {
        form.on('submit', function (e)
        {
            e.preventDefault();

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url:  ajax.url,
                data: form.serialize(),
                success: function(data)
                {
                    console.log(data);
                },
                error: function(error)
                {
                    toastr.error("Something went wrong: " + error);
                }
            });
        });
    }
});
