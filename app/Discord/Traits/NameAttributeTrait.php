<?php

namespace App\Discord\Traits;

trait NameAttributeTrait
{
    public function getNameAttribute($name, $result = [])
    {
        foreach (explode(' ', $name) as $word) {
            if (!$this->isEncoded($word)) {
                $result[] = $word;
                continue;
            }

            $result[] = $this->convertFromBytes($word);
        }

        return join(' ', $result);
    }

    protected function convertFromBytes($word) {
        return join('', array_map('hex2bin', explode('\\u', $word)));
    }

    protected function isEncoded($word) {
        return substr($word, 0, 2) === '\\u';
    }
}
