<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Weekcomment extends Model
{
    public function week() {
      return $this->belongsTo('App\Week');
    }
}
