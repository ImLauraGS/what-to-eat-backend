<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    /**
 * The attributes that are mass assignable.
 *
 * @var array<int, string>
 */
protected $fillable = [
    'title',
    'description',
    'ingredients',
    'tiktok',
    'youtube'

];
//campos que son rellenables

/**
 * The attributes that should be hidden for serialization.
 *
 * @var array<int, string>
 */
protected $hidden = [
    'created_at',
    'updated_at',
];
//campos que no queremos que se vean
public function user(){
return $this->belongsTo(User::class);
}
}
