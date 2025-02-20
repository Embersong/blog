<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Post extends Model
{

    protected $fillable = ['title', 'text', 'category_id', 'image'];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeTitle(Builder $query, $title): Builder
    {
        return $query->where('title', 'like', "%$title%");
    }

    public function scopeText(Builder $query, $title): Builder
    {
        return $query->where('text', 'like', "%$title%");
    }

    public function scopeTitleAndText(Builder $query, $text): Builder
    {
        return $query->where('title', 'like', "%$text%")->orWhere('text', 'like', "%$text%");
    }

}
