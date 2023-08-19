<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'status', 'description','user_id'];
    protected $table = 'todos';

    public function user(){
        return $this->belongsTo(User::class);
    }


}
