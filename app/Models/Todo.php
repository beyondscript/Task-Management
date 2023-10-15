<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'completed',
        'supervisor_id',
        'stuff_id',
    ];

    public function assignor()
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'stuff_id');
    }
}
