<?php

namespace App\Models;

use App\Models\Author\Author;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded=[];

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
    public function author(){
        return $this->belongsTo(Author::class,'author_id');
    }
    public function tag_rel(){
        return $this->hasMany(Tag::class,'tag_id');
    }
}
