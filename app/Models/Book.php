<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    protected $table = 'books';

    protected $fillable = [
        'cover_image',
        'title',
        'author',
        'publisher_id',
        'publish_year',
        'language',
        'location',
        'category_id',
        'call_number',
        'isbn',
        'pages',
        'description',
        'edition',
        'stock',
    ];


    public function publisher():BelongsTo
    {
        return $this->belongsTo(Publisher::class, 'publisher_id');
    }
    public function category():BelongsTo{
        return $this->belongsTo(Category::class, 'category_id');
    }
}
