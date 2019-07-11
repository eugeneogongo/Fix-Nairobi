<?php

namespace FixNairobi;

use Illuminate\Database\Eloquent\Model;

class IssueStatus extends Model
{
    //

    protected $fillable = ['issueid'];

    protected $table = 'IssueStatus';
}
