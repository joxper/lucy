<?php

namespace App\Http\Queries;

use App\Models\Modules\Client;
use App\Models\Modules\Assets;
use DB;


class ClientAssets extends Queries{

    protected $scoped;

    public function __construct($scoped = null)
    {
        $this->scoped = $scoped ?: new Client;
    }


    public function get()
    {

    }


}