<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    public function scopeFilter($query, array $filters)
    {
      if($filters['tag'] ?? false)
      {
        $query->where('tags', 'like', '%' . request('tag') . '%'); //what we're doig here is an sql like query || It's just going to search for whatever that tag is in this search column
      }

      if($filters['search'] ?? false)
      {
        $query->where('title', 'like', '%' . request('search') . '%')
        ->orWhere('description', 'like', '%' . request('search') . '%')
        ->orWhere('tags', 'like', '%' . request('search') . '%'); //what we're doig here is an sql like query || It's just going to search for whatever that tag is in this search column
      }
    }
}
