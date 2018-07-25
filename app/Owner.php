<?php

namespace MariusLab;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Owner extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Task owners id as it relates to a third party app;
     *
     * @var integer
     */
    protected $third_party_id;

    /**
     * crypt() encrypted API key
     *
     * @var string
     */
    protected $api_key;

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
