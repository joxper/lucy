<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    /**
     * {@inheritDoc}
     */
    protected $table = 'configurations';

    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'name', 'value', 'description',
    ];

    /**
     * Get value of configuration based on name.
     * 
     * @param  string  $name
     * @return mixed
     */
    public static function getValue($name)
    {
        return static::where('name', $name)->first()->value;
    }

    /**
     * Set new value to the given name.
     * 
     * @param  string  $name
     * @return bool
     */
    public static function setValue($name, $value = null)
    {
        return static::where('name', $name)->first()->update(['value' => $value]);
    }
}
