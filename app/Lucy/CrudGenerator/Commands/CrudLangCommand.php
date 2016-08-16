<?php

namespace App\Lucy\CrudGenerator\Commands;

class CrudLangCommand extends GeneratorCommand
{
    /**
     * {@inheritDoc}
     */
    protected $signature = 'lucy:lang {name : The module\'s name.}
            {--lines= : The lines of the language (example: key:string|key:string).}
            {--locale=en : The locale of the file.}';

    /**
     * {@inheritDoc}
     */
    protected $description = 'Create a new language file';

    /**
     * {@inheritDoc}
     */
    protected $type = 'Language';

    /**
     * {@inheritDoc}
     */
    protected function getStub()
    {
        return __DIR__.'/../stubs/lang.stub';
    }

    /**
     * {@inheritDoc}
     */
    protected function parseName($name)
    {
        return $name;
    }

    /**
     * {@inheritDoc}
     */
    protected function getPath($name)
    {
        $name = strtolower(str_singular($name));

        return base_path('resources/lang/'.$this->option('locale').'/'.$name.'.php');
    }

    /**
     * {@inheritDoc}
     */
    protected function buildClass($name)
    {
        $stub = $this->files->get($this->getStub());

        $name = ucwords(strtolower(str_singular($name)));

        $lines = explode('|', $this->option('lines'));
        $langLines = $this->buildLangLines($lines);

        return $this->replaceAppName($stub)->replaceModuleName($stub, $name)->replaceLangs($stub, $langLines);
    }

    /**
     * Build the language lines.
     * 
     * @param  array  $lines
     * @return string
     */
    protected function buildLangLines(array $lines)
    {
        foreach ($lines as $line) {
            $line = explode(':', $line);

            $key = $line[0];
            $string = addslashes($line[1]);

            if (! isset($langLines)) {
                $langLines = "'{$key}' => '{$string}',";
            } else {
                $langLines .= PHP_EOL.str_repeat(' ', 4)."'{$key}' => '{$string}',";
            }
        }

        return isset($langLines) ? $langLines : '';
    }

    /**
     * Replace the module name.
     * 
     * @param  string  $stub
     * @param  string  $name
     * @return \App\Lucy\CrudGenerator\Commands\CrudLangCommand
     */
    protected function replaceModuleName(&$stub, $name)
    {
        $stub = str_replace('{{name}}', $name, $stub);

        return $this;
    }

    /**
     * Replace the app name.
     * 
     * @param  string  $stub
     * @return \App\Lucy\CrudGenerator\Commands\CrudLangCommand
     */
    protected function replaceAppName(&$stub)
    {
        $stub = str_replace('{{app_name}}', lucy_config('APP_NAME'), $stub);

        return $this;
    }

    /**
     * Replace the language lines.
     * 
     * @param  string  $stub
     * @param  string  $lines
     * @return string
     */
    protected function replaceLangs(&$stub, $lines)
    {
        return str_replace('{{langs}}', $lines, $stub);
    }
}
