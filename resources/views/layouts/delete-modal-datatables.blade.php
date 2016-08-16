<div id="delete-modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">{{ trans('lucy.app.confirmation') }}</h4>
            </div>
            <div class="modal-body">
                <p>{{ trans('lucy.app.are-you-sure-delete') }}</p>
            </div>
            <div class="modal-footer">
                {!! Form::open(['id' => 'destroy', 'method' => 'DELETE']) !!}
                    <a id="delete-modal-cancel" href="#" class="btn btn-default" data-dismiss="modal">{{ trans('lucy.word.cancel') }}</a>&nbsp;{!! Form::submit(trans('lucy.word.continue'), ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('[data-tables=true]').on('click', '[data-button=delete]', function(e) {
            var id = $(this).attr('data-id');
            $('#destroy').attr('action', '{!! Request::url() !!}/'+id);
            $('#delete-modal').modal('show');
            e.preventDefault();
        });
    });
</script>
