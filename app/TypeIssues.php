<?php
/**
 * Developed by Eugene Ogongo on 7/20/19 10:44 AM
 * Author Email: eugeneogongo@live.com
 * Last Modified 7/20/19 10:41 AM
 * Copyright (c) 2019 . All rights reserved
 */

namespace FixNairobi;

use Illuminate\Database\Eloquent\Model;

class TypeIssues extends Model
{
    //set table name
    protected $table = "Type_issues";
    protected $fillable=["desc"];

    public function problem()
    {
        return $this->hasMany(Problem::class, 'issueid', 'id');
    }

}
