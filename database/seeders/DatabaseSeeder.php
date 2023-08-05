<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Chat;
use App\Models\Contact;
use App\Models\FileMessageDetail;
use App\Models\Message;
use App\Models\TextMessageDetail;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'user@one.com',
            "username" => 'user_one',
            "password" => Hash::make("1234")
        ]);

        User::factory()->create([
            'name' => 'Test User Two',
            'email' => 'user@two.com',
            "username" => 'user_two',
            "password" => Hash::make("1234")
        ]);

        User::factory(8)->create();

        (new Contact(["user_id" => 1, "contact" => 2]))->save();
        (new Contact(["user_id" => 1, "contact" => 3]))->save();
        (new Contact(["user_id" => 1, "contact" => 4]))->save();
        (new Contact(["user_id" => 1, "contact" => 5]))->save();
        (new Contact(["user_id" => 1, "contact" => 6]))->save();

        (new Contact(["user_id" => 2, "contact" => 1]))->save();

        (new Chat(["member_one" => 1, "member_two" => 2]))->save();
        (new Chat(["member_one" => 1, "member_two" => 3]))->save();
        (new Chat(["member_one" => 1, "member_two" => 4]))->save();
        (new Chat(["member_one" => 1, "member_two" => 5]))->save();
        (new Chat(["member_one" => 1, "member_two" => 7]))->save();

        $data = (new Message([
            "chat_id" => 1,
            "member_id" => 1,
            "type" => "text"
        ]));

        $data->save();

        (new TextMessageDetail([
        "message_id" => $data->id,
        "body" => "Hello User Two"
        ]))->save();

        $data = (new Message([
            "chat_id" => 1,
            "member_id" => 2,
            "type" => "text"
        ]));

        $data->save();

        (new TextMessageDetail([
        "message_id" => $data->id,
        "body" => "Hi User One?"
        ]))->save();


        $data = (new Message([
            "chat_id" => 1,
            "member_id" => 1,
            "type" => "file"
        ]));

        $data->save();

        (new FileMessageDetail([
        "message_id" => $data->id,
        "path" => "/images/photo.jpeg"
        ]))->save();

        $data = (new Message([
            "chat_id" => 1,
            "member_id" => 2,
            "type" => "text"
        ]));

        $data->save();

        (new TextMessageDetail([
        "message_id" => $data->id,
        "body" => "How u doin?"
        ]))->save();

        $data = (new Message([
            "chat_id" => 1,
            "member_id" => 1,
            "type" => "file"
        ]));

        $data->save();

        (new FileMessageDetail([
        "message_id" => $data->id,
        "path" => "/videos/show.mp4"
        ]))->save();

        $data = (new Message([
            "chat_id" => 1,
            "member_id" => 2,
            "type" => "file"
        ]));

        $data->save();


        (new FileMessageDetail([
        "message_id" => $data->id,
        "path" => "/pdf/course.pdf"
        ]))->save();

        $data = (new Message([
            "chat_id" => 1,
            "member_id" => 1,
            "type" => "text"
        ]));

        $data->save();

        (new TextMessageDetail([
        "message_id" => $data->id,
        "body" => "Iwa"
        ]))->save();

        $data = (new Message([
            "chat_id" => 1,
            "member_id" => 2,
            "type" => "text"
        ]));

        $data->save();

        (new TextMessageDetail([
        "message_id" => $data->id,
        "body" => "Men 3andek"
        ]))->save();
    }
}