jQuery(document).ready(function($){
    let form = $('#crowd_importer_form');

    if(form.length)
    {
        var subminBtn = $('#ci_submit_btn');
        var spinner = $('#wp_spinner');
        form.on('submit', function (e)
        {
            subminBtn.addClass('disabled');
            spinner.addClass('is-active');
            e.preventDefault();

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url:  ajax.url,
                data: form.serialize(),
                success: function(response)
                {
                    if(response.success)
                    {
                        showNotice(
                            true,
                            'We\'ve correclty imported ' + response.uploaded + 'bugs.'
                        )
                    }else
                    {
                        showNotice(false, response.data);
                    }

                    subminBtn.removeClass('disabled');
                    spinner.removeClass('is-active');
                },
                error: function(error)
                {
                    alert("Something went wrong: " + error);
                    subminBtn.removeClass('disabled');
                    spinner.removeClass('is-active');
                }
            });
        });

        function showNotice(is_ok, text)
        {
            var notice = $('#import_notice');
            var nText = $('#import_result');

            //Reset
            notice.removeClass('notice-success').removeClass('notice-error');
            nText.empty();

            //Update notice
            notice.addClass(!is_ok ? 'notice-error' : 'notice-success');
            nText.text(text);

            notice.show();
        }
    }
});
