<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'description',
    ];

    /**
     * Get all of the projects for the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    /**
     * Get all of the Tasks for the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
