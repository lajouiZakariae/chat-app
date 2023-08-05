<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Chat extends Model
{
    use HasFactory;

    public static function messages($id)
    {
        return DB::table("messages")
            ->select(
                "messages.id AS message_id",
                "messages.type AS type",
                "messages.created_at AS created_at",
                "messages.member_id AS member_id",
                "text_message_details.body AS body",
                "file_message_details.path AS path"
            )
            ->leftJoin("text_message_details", "messages.id", "=", "text_message_details.message_id")
            ->leftJoin("file_message_details", "messages.id", "=", "file_message_details.message_id")
            ->where("messages.chat_id", "=", $id)
            ->get();
    }
}