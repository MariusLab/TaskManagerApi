<?php

namespace MariusLab;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Title of the task
     *
     * @var string
     */
    protected $title;

    /**
     * Description of the task
     *
     * @var string
     */
    protected $description;

    /**
     * Due date for completing task
     *
     * @var \datetime|null
     */
    protected $due_date;

    /**
     * Task completion date; Null if not completed;
     *
     * @var \datetime|null
     */
    protected $completed_date;

    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }
}
