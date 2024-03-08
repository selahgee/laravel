<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notifications'; // Specify the table name if it's different
    protected $primaryKey = 'id'; // Specify the primary key if it's different
    public $timestamps = false; // Disable timestamps if not needed

    protected $fillable = ['user_id', 'message', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
