<?php

namespace App\Lucy\CrudGenerator\Commands;

use InvalidArgumentException;

class CrudViewCommand extends GeneratorCommand
{
    /**
     * {@inheritDoc}
     */
    protected $signature = 'lucy:view {name : The Module name.}
            {--controller= : The controller\'s class.}
            {--request= : The request\'s class.}
            {--columns= : The module\'s columns (example: column:method,caption|name:string,Name).}
            {--dropdown= : The field that must use dropdown (example: column:table|created_by:users).}
            {--module= : The ID of the module.}
            {--icon=fa-file : The module\'s icon.}';

    /**
     * {@inheritDoc}
     */
    protected $description = 'Create views for the Module';

    /**
     * {@inheritDoc}
     */
    protected $type = 'View';

    /**
     * The view's types.
     *
     * @var array
     */
    protected $types = [
        'form', 'index', 'view',
    ];

    /**
     * The columns for the table.
     *
     * @var array
     */
    protected $columns = [];

    /**
     * The datatables data for table.
     *
     * @var array
     */
    protected $datatables = [];

    /**
     * Indicates if the form must use the `header` section.
     *
     * @var bool
     */
    protected $useHeader = false;

    /**
     * The `header` script.
     *
     * @var string
     */
    protected $header = '';

    /**
     * Indicates if the form must use the `scripts` section.
     *
     * @var bool
     */
    protected $useScripts = false;

    /**
     * The `scripts` script.
     *
     * @var string
     */
    protected $scripts = '';

    /**
     * The scripts that must be included.
     *
     * @var string
     */
    protected $scriptSrc = '';

    /**
     * The module's forms.
     *
     * @var array
     */
    protected $forms = [];

    /**
     * Script for module detail.
     *
     * @var string
     */
    protected $moduleDetail = '';

    /**
     * Form's types that must use the `header` section.
     *
     * @var array
     */
    protected $typeMustUseHeader = [
        'boolean', 'date',
    ];

    /**
     * Form's types that must use the `scripts` section.
     *
     * @var array
     */
    protected $typeMustUseScripts = [
        'boolean', 'date',
    ];

    /**
     * Fields that must use dropdown.
     *
     * @var array
     */
    protected $dropdownFields = [];

    /**
     * The table for the dropdown.
     *
     * @var array
     */
    protected $tableDropdownFields = [];

    /**
     * {@inheritDoc}
     */
    protected function getStub()
    {
        //
    }

    /**
     * Get the view stub file for the generator by type.
     *
     * @param  string  $type
     * @return string
     *
     * @throws \InvalidArgumentException
     */
    protected function getViewStub($type)
    {
        $this->validateType($type);

        return __DIR__."/../stubs/{$type}.view.stub";
    }

    /**
     * {@inheritDoc}
     */
    protected function getPath($name)
    {
        return base_path('resources/views/modules/'.snake_case($this->argument('name')).'/'.$name.'.blade.php');
    }

    /**
     * {@inheritDoc}
     */
    protected function buildClass($name)
    {
        $stub = $this->files->get($this->getViewStub($name));

        return $this->replaceController($stub)->replaceModuleColumn($stub)->replaceModuleDatatables($stub)->replaceModuleHeader($stub)->replaceModuleScripts($stub)->replaceModuleForm($stub)->replaceModuleDetail($stub)->replaceRequest($stub)->replaceIcon($stub)->replaceModule($stub);
    }

    /**
     * Replace the module's name.
     *
     * @param  string  $stub
     * @return string
     */
    protected function replaceModule(&$stub)
    {
        $stub = str_replace('{{module}}', snake_case($this->argument('name')), $stub);

        return str_replace('{{Module}}', $this->argument('name'), $stub);
    }

    /**
     * Replace the controller class.
     *
     * @param  string  $stub
     * @return \App\Lucy\CrudGenerator\Commands\CrudViewCommand
     */
    protected function replaceController(&$stub)
    {
        if (! $this->option('controller')) {
            $this->error('Please specify the controller class.');
            exit();
        }

        $stub = str_replace('{{Controller}}', $this->option('controller'), $stub);

        return $this;
    }

    /**
     * Replace the request class.
     *
     * @param  string  $stub
     * @return \App\Lucy\CrudGenerator\Commands\CrudViewCommand
     */
    protected function replaceRequest(&$stub)
    {
        if (! $this->option('request')) {
            $this->error('Please specify the request class.');
            exit();
        }

        $stub = str_replace('{{Request}}', $this->option('request'), $stub);

        return $this;
    }

    /**
     * Replace the table's column.
     *
     * @param  string  $stub
     * @return \App\Lucy\CrudGenerator\Commands\CrudViewCommand
     */
    protected function replaceModuleColumn(&$stub)
    {
        foreach ($this->columns as $column) {
            $column = "<th class=\"center-align\">{$column}</th>";

            if (isset($replace)) {
                $replace .= PHP_EOL.str_repeat(' ', 4).$column;
            } else {
                $replace = $column;
            }
        }

        $stub = str_replace('{{Module Column}}', $replace, $stub);

        return $this;
    }

    /**
     * Replace the datatables options.
     *
     * @param  string  $stub
     * @return \App\Lucy\CrudGenerator\Commands\CrudViewCommand
     */
    protected function replaceModuleDatatables(&$stub)
    {
        foreach ($this->datatables as $data) {
            $data = "{data: '{$data}', name: '{$data}'},";

            if (isset($replace)) {
                $replace .= PHP_EOL.str_repeat(' ', 4).$data;
            } else {
                $replace = $data;
            }
        }

        $stub = str_replace('{{Module Datatables}}', $replace, $stub);

        return $this;
    }

    /**
     * Replace the module's form.
     *
     * @param  string  $stub
     * @return \App\Lucy\CrudGenerator\Commands\CrudViewCommand
     */
    protected function replaceModuleForm(&$stub)
    {
        foreach ($this->forms as $form) {
            $form = generate_form($form['type'], $form['name'], $form['caption'], $form['options']);

            if (isset($replace)) {
                $replace .= PHP_EOL.str_repeat(' ', 4).$form;
            } else {
                $replace = $form;
            }
        }

        $stub = str_replace('{{Module Form}}', $replace, $stub);

        return $this;
    }

    /**
     * Replace the module's form header.
     *
     * @param  string  $stub
     * @return \App\Lucy\CrudGenerator\Commands\CrudViewCommand
     */
    protected function replaceModuleHeader(&$stub)
    {
        if ($this->useHeader) {
            $stub = str_replace('{{Module Form Header}}', $this->buildHeader(), $stub);
        } else {
            $stub = str_replace('{{Module Form Header}}', '', $stub);
        }

        return $this;
    }

    /**
     * Build the `header` section.
     *
     * @return string
     */
    protected function buildHeader()
    {
        return str_repeat(PHP_EOL, 2)."@section('header')".$this->header.PHP_EOL.'@endsection';
    }

    /**
     * Build the header for `boolean` form.
     *
     * @return string
     */
    protected function buildHeaderBoolean()
    {
        return PHP_EOL.str_repeat(' ', 4)."{!! Html::style('bower_components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css') !!}";
    }

    /**
     * Build the header for `date` form.
     *
     * @return string
     */
    protected function buildHeaderDate()
    {
        return PHP_EOL.str_repeat(' ', 4)."{!! Html::style('bower_components/AdminLTE/plugins/datepicker/datepicker3.css') !!}";
    }

    /**
     * Replace the module's form scripts.
     *
     * @param  string  $stub
     * @return \App\Lucy\CrudGenerator\Commands\CrudViewCommand
     */
    protected function replaceModuleScripts(&$stub)
    {
        if ($this->useScripts) {
            $stub = str_replace('{{Module Form Script}}', $this->buildScripts(), $stub);
        } else {
            $stub = str_replace('{{Module Form Script}}', '', $stub);
        }

        return $this;
    }

    /**
     * Build the `scripts` section.
     *
     * @return string
     */
    protected function buildScripts()
    {
        return $this->scriptSrc.str_repeat(PHP_EOL, 2).str_repeat(' ', 4).'<script>'.PHP_EOL.str_repeat(' ', 8)."\$(document).ready(function () {".$this->scripts.PHP_EOL.str_repeat(' ', 8).'});'.PHP_EOL.str_repeat(' ', 4).'</script>';
    }

    /**
     * Build the scripts for `boolean` form.
     *
     * @return string
     */
    protected function buildScriptsBoolean()
    {
        $this->scriptSrc .= PHP_EOL.str_repeat(' ', 4)."{!! Html::script('bower_components/bootstrap-switch/dist/js/bootstrap-switch.min.js') !!}";

        return PHP_EOL.str_repeat(' ', 12)."\$('.switch').bootstrapSwitch({".PHP_EOL.str_repeat(' ', 16)."size: 'small'".PHP_EOL.str_repeat(' ', 12).'});';
    }

    /**
     * Build the scripts for `date` form.
     *
     * @return string
     */
    protected function buildScriptsDate()
    {
        $this->scriptSrc .= PHP_EOL.str_repeat(' ', 4)."{!! Html::script('bower_components/AdminLTE/plugins/datepicker/bootstrap-datepicker.js') !!}";

        return PHP_EOL.str_repeat(' ', 12)."\$('.lucy-date').datepicker({".PHP_EOL.str_repeat(' ', 16).'autoclose: true,'.PHP_EOL.str_repeat(' ', 16)."format: 'yyyy-mm-dd'".PHP_EOL.str_repeat(' ', 12).'});';
    }

    /**
     * Replace the detail of spesific module's resource.
     *
     * @param  string  $stub
     * @return \App\Lucy\CrudGenerator\Commands\CrudViewCommand
     */
    protected function replaceModuleDetail(&$stub)
    {
        $stub = str_replace('{{Module Detail}}', $this->moduleDetail, $stub);

        return $this;
    }

    /**
     * Build the detail of the spesific module's resource.
     *
     * @param  string  $type
     * @param  string  $name
     * @param  string  $caption
     * @return void
     */
    protected function buildModuleDetail($type, $name, $caption)
    {
        $detail = "{!! Form::group('static', '{$name}', '{$caption}', \$data['{$name}']) !!}";
        if (in_array($type, ['longText', 'mediumText', 'text'])) {
            $detail = "{!! Form::group('static', '{$name}', '{$caption}', nl2br(\$data['{$name}'])) !!}";
        }

        $this->moduleDetail .= (strlen($this->moduleDetail) ? PHP_EOL.str_repeat(' ', 4) : '').$detail;
    }

    /**
     * Throw exception if type is not valid.
     *
     * @return void
     *
     * @throws \InvalidArgumentException
     */
    protected function validateType($type)
    {
        if (! in_array($type, $this->types)) {
            throw new InvalidArgumentException("Invalid view's type ({$type}).");
        }
    }

    /**
     * {@inheritDoc}
     */
    public function fire()
    {
        $this->init();

        foreach ($this->types as $type) {
            $path = $this->getPath($type);

            if ($this->alreadyExists($type)) {
                $this->error(ucfirst($type).' view already exists!');

                return false;
            }

            $this->makeDirectory($path);

            $this->files->put($path, $this->buildClass($type));

            $this->saveFilePath($path);

            $this->info(ucfirst($type).' view created successfully.');
        }
    }

    /**
     * {@inheritDoc}
     */
    protected function alreadyExists($rawName)
    {
        return $this->files->exists($this->getPath($rawName));
    }

    /**
     * Initialize the command.
     *
     * @return void
     */
    protected function init()
    {
        if (! $this->option('columns')) {
            $this->error('Please specify the columns.');
            exit();
        }

        if (strlen($this->option('dropdown'))) {
            foreach (explode('|', $this->option('dropdown')) as $column) {
                list($column, $table) = explode(':', $column);

                $this->dropdownFields[] = $column;
                $this->tableDropdownFields[$column] = $table;
            }
        }

        foreach (explode('|', $this->option('columns')) as $column) {
            $column = explode(':', $column);
            $arguments = explode(',', $column[1]);

            $options = [];
            if (in_array($column[0], $this->dropdownFields)) {
                $options = ['table' => $this->tableDropdownFields[$column[0]]];
            }

            $this->columns[] = $arguments[1];
            $this->datatables[] = $column[0];
            $this->forms[] = [
                'type' => $arguments[0],
                'name' => $column[0],
                'caption' => $arguments[1],
                'options' => $options,
            ];

            if (in_array($arguments[0], $this->typeMustUseHeader)) {
                $this->useHeader = true;

                if (method_exists($this, $headerMethod = 'buildHeader'.ucfirst(strtolower($arguments[0])))) {
                    $this->header .= $this->{$headerMethod}();
                }
            }

            if (in_array($arguments[0], $this->typeMustUseScripts)) {
                $this->useScripts = true;

                if (method_exists($this, $scriptsMethod = 'buildScripts'.ucfirst(strtolower($arguments[0])))) {
                    $this->scripts .= (strlen($this->scripts) ? PHP_EOL : '').$this->{$scriptsMethod}();
                }
            }

            $this->buildModuleDetail($arguments[0], $column[0], $arguments[1]);
        }
    }

    /**
     * Replace the module's icon.
     *
     * @param  string  $stub
     * @return \App\Lucy\CrudGenerator\Commands\CrudViewCommand
     */
    protected function replaceIcon(&$stub)
    {
        $stub = str_replace('{{ Module Icon }}', $this->option('icon'), $stub);

        return $this;
    }
}
