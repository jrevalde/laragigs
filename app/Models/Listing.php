<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'company', 'location', 'website', 'email', 'description', 'tags']; //this is necessary for the model to create new row in database. it lets laravel know which fields are allowed to be filled.

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
