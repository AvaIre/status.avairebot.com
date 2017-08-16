<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Shard extends Model
{
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'count', 'address'
    ];

    /**
     * Checks if the shard is online.
     *
     * @return boolean
     */
    public function getOnlineAttribute()
    {
        return ! Carbon::parse($this->updated_at)->addMinutes(2)->isPast();
    }

    /**
     * Convert the model instance to an array.
     *
     * @return array
     */
    public function toArray()
    {
        $array = parent::toArray();

        $status = [
            'status' => [
                'id' => $this->online ? 1 : 0,
                'name' => $this->online ? 'online' : 'offline'
            ]
        ];

        $position = array_search('created_at', array_keys($array));
        return array_merge(array_slice($array, 0, $position), $status, array_slice($array, $position));;
    }
}
