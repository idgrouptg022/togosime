<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    protected $guarded = [];

    public function pathShow() {
        return url("admin/services/{$this->id}-". Str::slug($this->titre). "/details");
    }

    public function pathUpdate() {
        return url("admin/services/{$this->id}". Str::slug($this->titre). "/update-processing");
    }
}
