<?php

namespace App\Lucy;

use Sentinel;

class Guard
{
    /**
     * Check if user has access or not.
     * 
     * @param  array|string  $permissions
     * @return bool
     */
    public static function hasAccess($permissions, $any = false)
    {
        // Always true for Administrator...
        if (Sentinel::check()->roles[0]->is_admin) {
            return true;
        }

        if ($any) {
            return Sentinel::check()->hasAnyAccess($permissions);
        }

        return Sentinel::check()->hasAccess($permissions);
    }
}
