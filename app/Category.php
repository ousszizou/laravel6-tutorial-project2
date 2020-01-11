<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;

class Category extends Model
{
  protected $fillable = ['name'];

  public function posts() {
    return $this->hasMany(Post::class);
  }

}
