<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'title',
        'description',
        'priority',
        'status',
        'category',
        'assigned_to'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function logs() {
        return $this->hasMany(TicketLog::class);
    }

    public function latestLog() {
        return $this->hasOne(TicketLog::class)->latest();
    }
}
