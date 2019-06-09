<?php

namespace FixNairobi;

use Illuminate\Database\Eloquent\Model;

class TypeIssues extends Model
{
    //set table name
    protected $table = "type_issues";
    protected $fillable=["desc"];

}
