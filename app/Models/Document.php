<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Document extends Model
{
    use HasFactory;
    protected $fillable = [
        'uuid',
        'title',
        'sender',
        'sender_email',
        'sender_dept',
        'sender_id',
        'recipient_dept',
        'communication',
        'qr_code_path',
        'last_nudge_sent_at'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($document) {
            // Generate UUID manually for MariaDB compatibility
            if (empty($document->uuid)) {
                $document->uuid = (string) Str::uuid(); // generates a 36-character UUID string
            }
        });
    }
}
