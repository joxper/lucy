<div class="form-group form-md-line-input form-md-floating-label{{ Form::hasError($name) }}">
        {!! Form::type($type, $name, $value, array_except($attributes, 'help_block')) !!}
        @if (isset($attributes['help_block']))
            {!! Form::type('help', 'help_block', $attributes['help_block']) !!}
        @endif
        {!! Form::label($name, $displayName) !!}
        {!! Form::errorMsg($name) !!}
</div> 