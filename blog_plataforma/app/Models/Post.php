<?php

namespace App\Models;

use App\Models\Categoria;
use App\Models\Tag;
use App\Models\Comentario;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'slug',
        'conteudo',
        'user_id'
    ];

    //relacionamento com o usuário.
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    //relacionamento com categorias.
    public function categorias(): BelongsToMany
    {
        return $this->belongsToMany(Categoria::class);
    }

    //relacionamento com tags.
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    //relacionamento com comentários.
    public function comentarios(): HasMany
    {
        return $this->hasMany(Comentario::class);
    }

    // cria um slug a partir do titulo.
    public static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            $post->slug = Str::slug($post->titulo);
        });

        static::updating(function ($post) {
            $post->slug = Str::slug($post->titulo);
        });
    }
};
