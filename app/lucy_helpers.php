<?php

/*
| AHLOO Helpers.
|
| @author Roni Yusuf Manalu <rymanalu@gmail.com>
*/

use App\Models\Log;
use App\Models\Configuration;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\Controller;

if (! function_exists('avatar_path')) {
    /**
     * Return avatar path location.
     * 
     * @param  null|string  $path
     * @return string
     */
    function avatar_path($path = null)
    {
        $avatar = public_path('storage/avatars');

        if (is_string($path)) {
            return $avatar.DIRECTORY_SEPARATOR.trim($path, DIRECTORY_SEPARATOR);
        }

        return $avatar;
    }
}

if (! function_exists('user_info')) {
    /**
     * Get logged user info.
     * 
     * @param  null|string  $column
     * @return mixed
     */
    function user_info($column = null)
    {
        if ($user = Sentinel::check()) {
            if (is_null($column)) {
                return $user;
            }

            if ('role' == $column) {
                return user_info()->roles[0];
            }

            return $user->{$column};
        }

        return null;
    }
}

if (! function_exists('link_to_avatar')) {
    /**
     * Generates link to avatar.
     * 
     * @param  null|string  $path
     * @return string
     */
    function link_to_avatar($path = null)
    {
        if (starts_with($path, 'http') || starts_with($path, 'https')) {
            return $path;
        }

        if (! file_exists(avatar_path($path)) || ! $path) {
            return 'http://lorempixel.com/128/128/';
        }

        return asset('storage/avatars').'/'.trim($path, DIRECTORY_SEPARATOR);
    }
}

if (! function_exists('datatables')) {
    /**
     * Shortcut for Datatables::of().
     * 
     * @param  mixed  $builder
     * @return mixed
     */
    function datatables($builder)
    {
        return Datatables::of($builder);
    }
}

if (! function_exists('lucy_config')) {
    /**
     * Shorcut for \App\Models\Configuration::getValue() and
     * \App\Models\Configuration::setValue().
     * If only give 1 argument, it means get.
     * If you give 2 arguments, it means set.
     * 
     * @param  string  $name
     * @return mixed
     */
    function lucy_config($name)
    {
        if (1 == func_num_args()) {
            return Configuration::getValue($name);
        }

        $args = func_get_args();

        return Configuration::setValue($args[0], $args[1]);
    }
}

if (! function_exists('lucy_array_add')) {
    /**
     * Merge an array to existing array if the key is not exists.
     * Or add value of array with separator if the key is exists.
     * 
     * @param  array  $toAdd
     * @param  array  $array
     * @param  string $separator
     * @return array
     */
    function lucy_array_add(array $toAdd, array $array = [], $separator = ' ')
    {
        foreach ($toAdd as $key => $value) {
            if (isset($array[$key])) {
                $array[$key] = trim($array[$key]).$separator.trim($value);
            } else {
                $array[$key] = trim($value);
            }
        }

        return $array;
    }
}

if (! function_exists('transaction')) {
    /**
     * Execute a Closure within a transaction.
     * 
     * @param  \Closure       $callback
     * @param  \Closure|null  $callbackIfFail
     * @return bool
     */
    function transaction(Closure $callback, Closure $callbackIfFail = null, $useFlash = true)
    {
        DB::beginTransaction();

        try {
            call_user_func($callback);

            DB::commit();

            if ($useFlash) {
                if (Request::isMethod('delete')) {
                    flash()->success(trans('lucy.message.success-delete'));
                } else {
                    flash()->success(trans('lucy.message.success-save'));
                }
            }

            return true;
        } catch (Exception $e) {
            if (is_callable($callbackIfFail)) {
                call_user_func($callbackIfFail);
            }

            DB::rollBack();
            Log::error($e->getMessage());

            if ($useFlash) {
                if (Request::isMethod('delete')) {
                    flash()->error(trans('lucy.message.fail-delete'));
                } else {
                    flash()->error(trans('lucy.message.fail-save'));
                }
            }

            return false;
        }
    }
}

if (! function_exists('redirect_action')) {
    /**
     * Shortcut to redirect()->action().
     * 
     * @param  string  $action
     * @param  array  $params
     * @return \Illuminate\Routing\Redirector
     */
    function redirect_action($action, $params = [])
    {
        return redirect()->action($action, $params);
    }
}

if (! function_exists('route_action')) {
    /**
     * Get the controller action by given object and method.
     * 
     * @param  \App\Http\Controllers\Controller  $controller
     * @param  string  $method
     * @return string
     */
    function route_action(Controller $controller, $method)
    {
        $class =  str_replace('App\Http\Controllers\\', '', get_class($controller));

        return $class.'@'.$method;
    }
}

if (! function_exists('save_avatar')) {
    /**
     * Save the given avatar.
     * 
     * @param  \Illuminate\Http\UploadedFile  $avatar
     * @param  null|string  $prevAvatarPath
     * @return bool|string
     */
    function save_avatar(UploadedFile $avatar, $prevAvatarPath = null)
    {
        if (! $avatar->isValid()) {
            return false;
        }

        $fileName = date('Y_m_d_His').'_'.str_random().'_'.$avatar->getClientOriginalName();

        $avatar->move(avatar_path(), $fileName);
        if ($prevAvatarPath && file_exists(avatar_path($prevAvatarPath))) {
            @unlink(avatar_path($prevAvatarPath));
        }

        $image = Image::make(avatar_path($fileName));
        $image->resize(128, 128);
        $image->save();

        return $fileName;
    }
}

if (! function_exists('delete_avatar')) {
    /**
     * Delete given avatar.
     * 
     * @param  string  $path
     * @return bool
     */
    function delete_avatar($path)
    {
        if ($path && file_exists(avatar_path($path))) {
            return unlink(avatar_path($path));
        }

        return true;
    }
}

if (! function_exists('lucy_log')) {
    /**
     * Log the user's activity.
     * 
     * @param  string    $message
     * @param  int|null  $user
     * @return void
     */
    function lucy_log($message, $user = null)
    {
        $user = $user ?: user_info('id');

        Log::insert([
            'user_id' => $user,
            'ip_address' => $_SERVER['REMOTE_ADDR'],
            'message' => $message,
            'user_agent' => $_SERVER['HTTP_USER_AGENT'],
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }
}

if (! function_exists('mail_send')) {
    /**
     * Send an email based on Mail Settings.
     * 
     * @param  string  $view
     * @param  array  $data
     * @param  \Closure  $callback
     * @return void
     */
    function mail_send($view, array $data = [], Closure $callback)
    {
        if ((bool) lucy_config('MAIL_QUEUE')) {
            return Mail::later(5, $view, $data, $callback);
        }

        return Mail::send($view, $data, $callback);
    }
}

if (! function_exists('set_type_by_column_type')) {
    /**
     * Set the variable type by column type.
     * 
     * @param  string  $columnType
     * @param  mixed  $var
     * @return bool
     *
     * @throws \InvalidArgumentException
     */
    function set_type_by_column_type(&$var, $columnType)
    {
        switch ($columnType) {
            case 'bigInteger':
            case 'integer':
            case 'mediumInteger':
            case 'smallInteger':
            case 'tinyInteger':
                return settype($var, 'integer');
                break;
            case 'boolean':
                if (in_array($var, [false, 'false', 'FALSE', 0, '0', null], true)) {
                    $var = false;
                }

                return settype($var, 'boolean');
                break;
            case 'char':
            case 'date':
            case 'dateTime':
            case 'enum':
            case 'ipAddress':
            case 'longText':
            case 'macAddress':
            case 'mediumText':
            case 'rememberToken':
            case 'softDeletes':
            case 'string':
            case 'text':
            case 'time':
            case 'timestamp':
            case 'uuid':
                return settype($var, 'string');
                break;
            case 'decimal':
            case 'double':
            case 'float':
                return settype($var, 'float');
                break;
            default:
                throw new InvalidArgumentException("Invalid column type ({$columnType}).");
                return false;
                break;
        }
    }
}

if (! function_exists('back_with_message')) {
    /**
     * Create a new redirect response to the previous
     * location with custom flash message.
     * 
     * @param  null|string  $message
     * @param  string  $type
     * @param  bool  $withInput
     * @return \Illuminate\Http\RedirectResponse
     */
    function back_with_message($message = null, $type = 'error', $withInput = true)
    {
        $back = back();

        if (is_string($message)) {
            flash()->{$type}($message);
        }

        if ($withInput) {
            return $back->withInput();
        }

        return $back;
    }
}

if (! function_exists('generate_form')) {
    /**
     * Generate a form.
     *
     * @param  string  $type
     * @param  string  $name
     * @param  null|string  $caption
     * @param  array  $options
     * @return string
     */
    function generate_form($type, $name, $caption = null, array $options = [])
    {
        if (is_null($caption)) {
            $caption = ucwords(strtolower(str_replace('_', ' ', $name)));
        }

        if ($options) {
            $table = $options['table'];

            return "{!! Form::group('select', '{$name}', '{$caption}', \$data['{$name}'], ['options' => DB::table('{$table}')->orderBy('id')->lists('id', 'id')]) !!}";
        }

        switch ($type) {
            case 'bigInteger':
            case 'integer':
            case 'mediumInteger':
            case 'smallInteger':
            case 'tinyInteger':
                return "{!! Form::group('number', '{$name}', '{$caption}', \$data['{$name}']) !!}";
                break;
            case 'char':
            case 'string':
            case 'decimal':
            case 'double':
            case 'float':
                return "{!! Form::group('text', '{$name}', '{$caption}', \$data['{$name}']) !!}";
                break;
            case 'longText':
            case 'mediumText':
            case 'text':
                return "{!! Form::group('textarea', '{$name}', '{$caption}', \$data['{$name}']) !!}";
                break;
            case 'boolean':
                return "{!! Form::checkRadio('checkbox', '{$name}', '{$caption}', true, ['class' => 'switch', 'checked' => \$data['{$name}'], 'data-on-text' => trans('lucy.word.yes'), 'data-off-text' => trans('lucy.word.no')]) !!}";
                break;
            case 'date':
                return "{!! Form::group('text', '{$name}', '{$caption}', \$data['{$name}'], ['readonly' => true, 'class' => 'lucy-date']) !!}";
                break;
            default:
                return "{!! Form::group('text', '{$name}', '{$caption}', \$data['{$name}']) !!}";
                break;
        }
    }
}

if (! function_exists('markdown')) {
    /**
     * Convert some text to markdown.
     *
     * @param  string  $text
     * @return string
     */
    function markdown($text)
    {
        return (new ParsedownExtra)->text($text);
    }
}
