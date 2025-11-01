<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EducationalContent extends Model
{
    protected $fillable = [
        'title', 'category', 'content', 'icon', 'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public static function getByCategory($category)
    {
        return self::where('category', $category)
            ->where('is_active', true)
            ->get();
    }
}
