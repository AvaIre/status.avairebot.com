<?php

namespace App\Discord;

use App\Discord\Permissions;

class Guild
{
    use Attributes;

    protected $attributes;

    public function __construct($discordGuild)
    {
        $this->attributes  = $discordGuild;
        $this->permissions = new Permissions($this);
    }

    public function has($permission)
    {
        return $this->permissions->{$permission};
    }

    public function getIcon()
    {
        if ($this->icon === null) {
            return asset('assets/img/no-guild.png');
        }
        return "https://cdn.discordapp.com/icons/{$this->id}/{$this->icon}.webp";
    }
}
