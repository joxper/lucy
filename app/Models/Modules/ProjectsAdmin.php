<?php

namespace App\Models\Modules;

use App\Lucy\Model;

class ProjectsAdmin extends Model
{
    /**
     * {@inheritDoc}
     */
    protected $table = 'projects_admins';

    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'project_id', 'user_id',
    ];

    /**
     * {@inheritDoc}
     */
    protected $primaryKey = 'id';

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
