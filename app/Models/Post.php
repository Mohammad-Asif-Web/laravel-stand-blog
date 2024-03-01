<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $guarded = [];

    // jdi foreign Id post table e thake tahle 'belongsTo', 'belongsToMany'
    // jdi foreign Id post table e na thake tahle 'hasOne', 'hasMany'

    public function tag()
    {
        return $this->belongsToMany(Tag::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // 'comment_id' column er je value null jegulo segulo ke call kra hoise
    public function comment()
    {
        return $this->hasMany(Comment::class)->whereNull('comment_id');
    }

}
