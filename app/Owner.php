<?php

namespace MariusLab;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    /**
     * Task owners id as it relates to a third party app;
     *
     * @var integer
     */
    protected $owner_id;

    /**
     * API key
     *
     * @var string
     */
    protected $api_key;

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
