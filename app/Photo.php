<?php

namespace FixNairobi;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //
    protected $table = 'photos';
    protected $fillable = ['path'];

    public function problem()
    {
        $this->belongsTo(Photo::class, 'issueid', 'id');
    }
}
