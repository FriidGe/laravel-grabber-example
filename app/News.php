<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class News
 *
 * @property integer     $id
 * @property string      $title
 * @property string      $text
 * @property string|null $img
 * @property string      $url
 * @package App
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\News newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\News newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\News query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\News whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\News whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\News whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\News whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\News whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\News whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\News whereUrl($value)
 * @mixin \Eloquent
 */
class News extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'text',
        'img',
        'url',
    ];
}
