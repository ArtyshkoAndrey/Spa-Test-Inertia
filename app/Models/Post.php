<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
  use HasFactory;

  protected $fillable = [
    'title',
    'content',
    'image'
  ];

  protected $appends = ['image_url'];

  function getImageUrlAttribute()
  {
    return $this->image ? url('/uploads/' . $this->image) : "";
  }
}
