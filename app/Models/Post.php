<?php

namespace App\Models;

use Eloquent;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Post
 *
 * @property int         $id
 * @property string      $title
 * @property string      $content
 * @property string|null $image
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read mixed  $image_url
 * @method static Builder|Post newModelQuery()
 * @method static Builder|Post newQuery()
 * @method static Builder|Post query()
 * @method static Builder|Post whereContent($value)
 * @method static Builder|Post whereCreatedAt($value)
 * @method static Builder|Post whereId($value)
 * @method static Builder|Post whereImage($value)
 * @method static Builder|Post whereTitle($value)
 * @method static Builder|Post whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Post extends Model
{
  use HasFactory;

  protected $fillable = [
    'title',
    'content',
    'image',
  ];

  protected $appends = ['image_url'];

  function getImageUrlAttribute()
  {
    return $this->image ? url('/storage/uploads/' . $this->image) : "";
  }
}
