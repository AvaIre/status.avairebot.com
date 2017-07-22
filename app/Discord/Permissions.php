<?php

namespace App\Discord;

use App\Discord\Guild;
use Illuminate\Support\Str;

class Permissions
{
    use Attributes;

    protected $bitwise = [
        'create_instant_invite' => 0,
        'kick_members'          => 1,
        'ban_members'           => 2,
        'administrator'         => 3,
        'manage_channels'       => 4,
        'manage_server'         => 5,
        'change_nickname'       => 26,
        'manage_nicknames'      => 27,
        'manage_roles'          => 28,
        'read_messages'         => 10,
        'send_messages'         => 11,
        'send_tts_messages'     => 12,
        'manage_messages'       => 13,
        'embed_links'           => 14,
        'attach_files'          => 15,
        'read_message_history'  => 17,
        'mention_everyone'      => 18,
        'voice_connect'         => 20,
        'voice_speak'           => 21,
        'voice_mute_members'    => 22,
        'voice_deafen_members'  => 23,
        'voice_move_members'    => 24,
        'voice_use_vad'         => 25,
    ];

    public function __construct(Guild $guild)
    {
        $this->fill($this->getDefault());

        $result = [];
        $permissions = $guild->attributes['permissions'];
        foreach ($this->bitwise as $key => $value) {
            $result[$key] = ((($permissions >> $value) & 1) == 1);
        }

        $this->fill($result);
    }

    public function fill($attributes)
    {
        foreach ($attributes as $key => $value) {
            $this->attributes[$key] = $value;
        }
    }

    public function getDefault()
    {
        return [
            'create_instant_invite' => true,
            'read_messages'        => true,
            'send_messages'        => true,
            'send_tts_messages'    => true,
            'embed_links'          => true,
            'attach_files'         => true,
            'read_message_history' => true,
            'mention_everyone'     => true,
            'voice_connect'        => true,
            'voice_speak'          => true,
            'voice_use_vad'        => true,
        ];
    }
}
