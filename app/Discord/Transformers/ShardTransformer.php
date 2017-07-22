<?php 

namespace App\Discord\Transformers;

class ShardTransformer
{
    protected $accessible = [
        'users', 'guilds', 'channels'
    ];

    public function __construct($shards)
    {
        $this->shards = $shards;
    }

    public function __get($property)
    {
        if (!in_array($property, $this->accessible)) {
            return 0;
        }
        return $this->shards->sum($property);
    }
}
