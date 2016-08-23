<?php

namespace App\Http\Queries;

use App\Models\Modules\Clients;
use App\Models\Modules\Assets;
use DB;
use Sentinel;

class Queries
{
    public function get($model, $column, $key)
    {
        $query= DB::table($model)
                ->where($column, $key)
                ->get();
        return $query;
    }

    public function count($model, $column, $key)
    {
        return count($this->get($model, $column, $key));
    }

    public function getUsers($role, $assignedList, $in)
    {
        if(!$in){
            $in = 'whereNotIn';
        }
        else{
            $in = 'whereIn';
        }
        $query= Sentinel::findRoleById($role)
                ->users()
                ->$in('id', $assignedList)
                ->with('roles')
                ->select('id', 'email', 'username', 'avatar', 'first_name', 'position')
                ->get();
        return $query;
    }

    public function getUsersAll($role, $assignedList, $in)
    {
        if(!$in){
            $in = 'whereNotIn';
        }
        else{
            $in = 'whereIn';
        }
        $query= Sentinel::findRoleById($role)
            ->users()
            ->$in('id', $assignedList)
            ->with('roles')
            ->get();
        return $query;
    }
}