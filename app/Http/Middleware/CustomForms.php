<?php

namespace App\Http\Middleware;

use Form;
use Closure;
use BadMethodCallException;

class CustomForms
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Get the errors from session...
        $errors = session('errors');

        // Extends Form::model()...
        Form::macro('horizontal', function ($options = [], $model = []) {
            $model = ($model) ? $model : [];

            $options = lucy_array_add([
                'class' => '',
                'autocomplete' => 'off',
            ], $options);

            return Form::model($model, $options);
        });

        Form::macro('horizontal_2', function ($options = [], $model = []) {
            $model = ($model) ? $model : [];

            $options = lucy_array_add([
                'class' => 'form-horizontal',
                'autocomplete' => 'off',
            ], $options);

            return Form::model($model, $options);
        });

        // If the field has errors, then add 'has-error' css class to the given field...
        Form::macro('hasError', function ($field) use ($errors) {
            if ($errors && $errors->has($field)) {
                return ' has-error';
            }

            return;
        });

        // Generate error message if the given field has errors...
        Form::macro('errorMsg', function ($field) use ($errors) {
            if ($errors && $errors->has($field)) {
                return sprintf('<p class="help-block text-danger">%s</p>', $errors->first($field));
            }

            return;
        });

        // Generate static control...
        Form::macro('staticControl', function ($value) {
            return sprintf('<p class="form-control-static">%s</p>', $value);
        });

        // Generate help block...
        Form::macro('helpBlock', function ($value) {
            return sprintf('<span class="help-block"><i>%s</i></span>', $value);
        });

        // Generate form field based on type...
        Form::macro('type', function ($type, $name, $value = null, $attributes = []) {
            $defaultAttr = ['class' => 'form-control'];
            if (in_array($type, ['checkbox', 'radio', 'file'])) {
                $defaultAttr = [];
            }

            $attributes = lucy_array_add($defaultAttr, $attributes);

            switch ($type) {
                case 'checkbox':
                case 'radio':
                    return Form::$type($name, $value, $attributes['checked'], array_except($attributes, 'checked'));
                    break;
                case 'select':
                    return Form::$type($name, $attributes['options'], $value, array_except($attributes, 'options'));
                    break;
                case 'text':
                case 'hidden':
                case 'textarea':
                case 'email':
                case 'number':
                case 'date':
                    return Form::$type($name, $value, $attributes);
                    break;
                case 'password':
                case 'file':
                case 'submit':
                case 'button':
                    return Form::$type($name, $attributes);
                    break;
                case 'static':
                    return Form::staticControl($value);
                case 'help':
                    return Form::helpBlock($value);
                default:
                    throw new BadMethodCallException("Call to undefined method [{$type}]!");
                    return;
            }
        });

        // Form group component...
        Form::component('group', 'components.group', ['type', 'name', 'displayName', 'value' => null, 'attributes' => []]);

        // Form group component...
        Form::component('group2', 'components.group2', ['type', 'name', 'displayName', 'value' => null, 'attributes' => []]);

        // Checkbox component...
        Form::component('checkRadio', 'components.check-radio', ['type', 'name', 'displayName', 'value' => null, 'attributes' => []]);

        return $next($request);
    }
}
