<?php

namespace FixNairobi;

use Illuminate\Database\Eloquent\Model;


class Problem extends Model
{
    //
    protected $table = 'problems';

    public function photo()
    {
        $this->hasOne(Photo::class, 'issueid', 'id');
    }

    public function status()
    {
        return $this->hasOne(IssueStatus::class, 'issueid', 'id');
    }
}
