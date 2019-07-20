<?php
/**
 * Developed by Eugene Ogongo on 7/20/19 10:44 AM
 * Author Email: eugeneogongo@live.com
 * Last Modified 7/20/19 10:41 AM
 * Copyright (c) 2019 . All rights reserved
 */

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
