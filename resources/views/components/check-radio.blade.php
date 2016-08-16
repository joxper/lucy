<div class="form-group{{ Form::hasError($name) }}">
    @if (isset($attributes['class']) && str_contains($attributes['class'], 'switch'))
        {!! Form::label($name, $displayName, ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::type($type, $name, $value, $attributes) !!}
            @if (isset($attributes['help_block']))
                {!! Form::type('help', 'help_block', $attributes['help_block']) !!}
            @endif
            {!! Form::errorMsg($name) !!}
        </div>
    @else
        <div class="col-sm-offset-3 col-sm-9">
            <div class="{{ $type }}">
                <label>
                    {!! Form::type($type, $name, $value, $attributes) !!} {{ $displayName }}
                    @if (isset($attributes['help_block']))
                        {!! Form::type('help', 'help_block', $attributes['help_block']) !!}
                    @endif
                    {!! Form::errorMsg($name) !!}
                </label>
            </div>
        </div>
    @endif
</div>