<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todolist extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['owner', 'category'];
    protected $dates = ['due'];

    const UPDATED_AT = null;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function owner()
    {
        // user_id alias owner
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeFilter($query, array $filters)
    {
            // // Versi Callback
            // // Filter title and body
            // $query->when($filters['search'] ?? false, function($query, $search)
            // {
            //     return $query->where('title', 'like', '%' . $search . '%')
            //                 ->orWhere('body', 'like', '%' . $search . '%');
            // });

            // // Arrow function
            // // Filter category
            // $query->when($filters['category'] ?? false, fn($query, $category) =>
            //     // Join table category
            //     $query->whereHas('category', fn($query) =>
            //         $query->where('slug', $category)
            //     )
            // );

            // // Filter owner
            // $query->when($filters['owner'] ?? false, fn($query, $owner) =>
            //     $query->whereHas('owner', fn($query) =>
            //         $query->where('username', $owner)
            //     )
            // );
    }

    // Route model binding in method resource
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getDateAttribute($dates)
    {
        return Carbon::parse($dates)->format('Y-m-d\TH:i');
    }
}
