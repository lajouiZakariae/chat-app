<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TextMessageDetail extends Model
{
    use HasFactory;

    protected $fillable = ["message_id", "body"];
    public $timestamps = false;
}