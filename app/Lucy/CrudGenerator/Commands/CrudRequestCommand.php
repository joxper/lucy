<?php

namespace App\Lucy\CrudGenerator\Commands;

class CrudRequestCommand extends GeneratorCommand
{
    /**
     * {@inheritDoc}
     */
    protected $signature = 'lucy:request {name : The class name.}
            {--rules= : The validation rules (example: field:rules|email:required,exists>users.email).}
            {--module= : The ID of the module.}';

    /**
     * {@inheritDoc}
     */
    protected $description = 'Create a new form request class';

    /**
     * {@inheritDoc}
     */
    protected $type = 'Request';

    /**
     * {@inheritDoc}
     */
    protected function getStub()
    {
        return __DIR__.'/../stubs/request.stub';
    }

    /**
     * {@inheritDoc}
     */
    protected function getPath($name)
    {
        $name = str_replace('\\', '/', str_replace($this->laravel->getNamespace(), '', $name));

        return app_path($name.'Request.php');
    }

    /**
     * {@inheritDoc}
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Http\Requests\Modules';
    }

    /**
     * {@inheritDoc}
     */
    protected function buildClass($name)
    {
        $stub = $this->files->get($this->getStub());

        return $this->replaceRules($stub)->replaceNamespace($stub, $name)->replaceClass($stub, $name);
    }

    /**
     * Replace the validation rules.
     * 
     * @param  string  $stub
     * @return \App\Lucy\CrudGenerator\Commands\CrudRequestCommand
     */
    protected function replaceRules(&$stub)
    {
        if (! $this->option('rules')) {
            $this->error('Please specify the validation rules.');
            exit();
        }

        $rules = explode('|', $this->option('rules'));

        foreach ($rules as $rule) {
            $rule = explode(':', $rule);

            $field = $rule[0];
            $fieldRules = str_replace(',', '|', $rule[1]);

            if (str_contains($fieldRules, '>')) {
                $fieldRules = str_replace('>', ':', $fieldRules);
            }

            if (str_contains($fieldRules, '.')) {
                $fieldRules = str_replace('.', ',', $fieldRules);
            }

            if (! isset($replace)) {
                $replace = "'{$field}' => '{$fieldRules}',";
            } else {
                $replace .= PHP_EOL.str_repeat(' ', 12)."'{$field}' => '{$fieldRules}',";
            }
        }

        $stub = str_replace('{{rules}}', $replace, $stub);

        return $this;
    }
}
