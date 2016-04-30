<?php

namespace PN\Forum\Listeners;


use Discord\Discord;
use Illuminate\Support\Str;

class PostForumPostInDiscord
{
    public function handle($event)
    {
        try {
            $post = $event->post;

            $_SERVER['PWD'] = storage_path('app');
            $discord = new Discord(env('DISCORD_EMAIL'), env('DISCORD_PASS'));

            $guild = $discord->guilds->get('id', env('DISCORD_GUILD_ID'));

            $channel = null;

            if(!Str::contains($post->thread->category->title, ['Support'])) {
                $channel = $guild->channels->get('id', env('DISCORD_CHANNEL_ACTIVITY_ID'));
            }

            if($channel != null) {
                if($post->thread->posts->count() == 1) { // thread created
                    $channel->sendMessage("{$post->user->username} created a new thread '{$post->thread->title}'. View it here {$post->url}");
                } else { // reply on thread
                    $channel->sendMessage("{$post->user->username} replied on '{$post->thread->title}'. View it here {$post->url}");
                }
            }
        } catch (\Exception $e) {

        }
    }
}
