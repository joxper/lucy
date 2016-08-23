@yield('attachForm')
<a id="delete-modal-cancel" href="#" class="btn btn-default" data-dismiss="modal">{{ trans('lucy.word.cancel') }}</a>
{{ Form::submit('Add', ['class' => 'btn purple-sharp']) }}
{{ Form::close() }}
<script>

    $('#attachForm')
    .on('success.form.fv', function(e) {
        // Save the form data via an Ajax request
        e.preventDefault();
        var $form  =    $(e.target),
            client =    $(this).attr('data-id');

        $.ajax({
            url: $form.attr('action'),
            method: 'POST',
            data: $form.serialize()
        }).success(function(response) {
            // Hide the dialog
            $form.parents('.bootbox').modal('hide');
        });
    });

    $('button#attachForm').on('click', function(){

        bootbox
                .dialog({
                    title: $('#attachForm').attr('title'),
                    message: $('#attachForm').show(),
                    show: false // We will show it manually later
                })
                .on('shown.bs.modal', function() {
                    $('#attachForm')
                            .show();             // Show the  form
                })
                .on('hide.bs.modal', function(e) {
                    // Bootbox will remove the modal (including the body which contains the login form)
                    // after hiding the modal
                    // Therefor, we need to backup the form
                    $('#attachForm').hide().appendTo('body');
                })
                .modal('show');
    });
</script>





























