<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketLog extends Model
{
    use HasFactory;
    protected $fillable = ['ticket_id', 'status', 'user_id', 'changed_at'];


    public function user() {
    return $this->belongsTo(User::class);
    }
}
