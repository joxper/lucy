<div class="form-group{{ Form::hasError($name) }}">
    {!! Form::label($name, $displayName, ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-9">
        {!! Form::type($type, $name, $value, array_except($attributes, 'help_block'), ['class' => 'form-control input-lg']) !!}
        @if (isset($attributes['help_block']))
            {!! Form::type('help', 'help_block', $attributes['help_block']) !!}
        @endif
        {!! Form::errorMsg($name) !!}
    </div>
</div>
