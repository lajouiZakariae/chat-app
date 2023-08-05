<?php

use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get("/user", function () {
    $user = User::find(1);
    return $user;
});

Route::get("/contacts", function () {
    $user = User::find(1);
    return $user->contacts();
});

Route::get("/chats", function () {
    $user = User::find(1);
    return Chat::select(["chats.member_two AS reciepent_id", "users.username AS username", "chats.id AS chat_id"])
        ->join("users", "chats.member_two", "=", "users.id")
        ->where("member_one", "=", $user->id)
        ->orWhere("member_one", "=", $user->id)
        ->get();
});

Route::get("/chats/{id}/messages", function ($id) {
    $user = User::find(1);

    // $chat = $user->chat($id);

    $chat = Chat::where("chats.id", $id)
        ->where(function (Builder $query) use ($user) {
            $query
                ->where("member_one", $user->id)
                ->orWhere("member_one", $user->id);
        })
        ->select("messages.id AS id", "body", "path", "member_id")
        ->join("messages", "chats.id", "=", "messages.chat_id")
        ->leftJoin("text_message_details", "messages.id", "=", "text_message_details.message_id")
        ->leftJoin("file_message_details", "messages.id", "=", "file_message_details.message_id")
        ->get();

    return $chat;
});