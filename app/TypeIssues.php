<?php

namespace FixNairobi;

use Illuminate\Database\Eloquent\Model;

class TypeIssues extends Model
{
    //set table name
    protected $table = "Type_issues";
    protected $fillable=["desc"];

}
