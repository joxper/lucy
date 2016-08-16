<?php

namespace App\Lucy;

use Illuminate\Database\Eloquent\Model as BaseModel;

abstract class Model extends BaseModel implements ModelInterface
{
    /**
     * {@inheritDoc}
     */
    public function datatables()
    {
        return static::select('*');
    }
}
