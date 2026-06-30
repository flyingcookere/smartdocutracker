<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentLog extends Model
{
    use HasFactory;

    protected $table = 'document_logs';
    protected $fillable = [
        'uuid',
        'title',
        'sender',
        'sender_id',
        'sender_email',
        'sender_dept',
        'recipient',
        'recipient_id',
        'recipient_email',
        'recipient_dept',
        'communication',
        'status',
        'remarks',
        'date_received',
    ];
}
