<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    use HasFactory;

    protected $table = 'technologies';

    protected $fillable = [
        'name',
        'slug'
    ];

    // funzione di relazione Many to Many con la tabella 'projects'
    public function projects() {
        return $this->belongsToMany(Project::class);
    }
}
