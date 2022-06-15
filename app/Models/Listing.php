<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'logo', 'company', 'location', 'website', 'email', 'description', 'tags', 'user_id']; //this is necessary for the model to create new row in database. it lets laravel know which fields are allowed to be filled.

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

    //Relationship To User
    public function user()
    {
      //theh relationship is going to be belongs to
      return $this->belongsTo(User::class, 'user_id');
    }
    
}
