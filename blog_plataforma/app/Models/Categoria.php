<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];


    public function post(): BelongsToMany
    {
        return $this->belongsToMany(Post::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($categoria) {
            $categoria->slug = Str::slug($categoria->name);
        });

        static::updating(function ($categoria) {
            $categoria->slug = Str::slug($categoria->name);
        });
    }
}
