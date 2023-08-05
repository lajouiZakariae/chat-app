<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileMessageDetail extends Model
{
    use HasFactory;

    protected $fillable = ["path", "message_id"];
    public $timestamps = false;
}