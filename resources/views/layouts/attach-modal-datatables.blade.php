{!! Html::script('bower_components/metronic/assets/global/plugins/bootbox/battributesn.js') !!}

{{ Form::open(['method' => 'POST', 'action' => ['Modules\ClientController@attachUser', 'id' => $client['data']['id']], 'id' => 'attach_form']) }}
{!! Form::group('hidden', 'client_id', 'Client Id', 'client_id') !!}
{!! Form::group('select', 'user_id', 'User Id', 'user_id', ['options' => $admins]) !!}
{{ Form::submit('Add', ['class' => 'btn purple-sharp']) }}
{{ Form::close() }}

<script>
    $('#attach_form')
    .on('success.form.fv', function(e) {
        // Save the form data via an Ajax request
        e.preventDefault();
        var $form  =    $(e.target),
            client =    $form.find('[name="client_id"]').val();

        $.ajax({
            url: '/clients/'+client+'/',
            method: 'POST',
            data: $form.serialize()
        }).success(function(response) {
            // Hide the dialog
            $form.parents('.bootbox').modal('hide');
        });
    });

    $('button#attach_btn').on('click', function(){

        var id = $(this).attr('data-id');
        $('#attach_form')
                .find('[name="user_id"]').end();
        bootbox
                .dialog({
                    title: 'Add User to Client',
                    message: $('#attach_form'),
                    show: false // We will show it manually later
                })
                .modal('show');
    });
</script>



























