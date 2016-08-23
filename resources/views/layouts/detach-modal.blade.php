{!! Html::script('bower_components/metronic/assets/global/plugins/bootbox/bootbox.min.js') !!}
<script>

        $('button#detach_btn').on('click', function(){
            var $form = document.getElementById ('detach_modal');
            bootbox.confirm("Are you sure?", function(result) {
                if(result == true)
                {
                    $("#detach_modal").submit();
                }
            });
        });

</script>

































