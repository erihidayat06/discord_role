<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class RemoveDiscordRole implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $discord_id;
    protected $role_id;
    protected $bot_token;
    protected $guild_id;

    /**
     * Create a new job instance.
     */
    public function __construct($discord_id, $role_id, $bot_token, $guild_id)
    {
        $this->discord_id = $discord_id;
        $this->role_id = $role_id;
        $this->bot_token = $bot_token;
        $this->guild_id = $guild_id;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        Http::withHeaders([
            'Authorization' => "Bot {$this->bot_token}",
            'Content-Type' => 'application/json',
        ])->delete("https://discord.com/api/v10/guilds/{$this->guild_id}/members/{$this->discord_id}/roles/{$this->role_id}");
    }
}
