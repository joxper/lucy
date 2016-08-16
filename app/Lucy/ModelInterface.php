<?php

namespace App\Lucy;

interface ModelInterface
{
    /**
     * Query Builder for Datatables.
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function datatables();
}
