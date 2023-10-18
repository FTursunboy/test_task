<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskNotification extends Model
{
    use HasFactory, SoftDeletes;

    public function user() {
        $this->belongsTo(User::class);
    }
}
