<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Site extends Model
{
    protected $guarded = ['id'];

    public function pathShow() {
        return url("admin/sites/{$this->id}-". Str::slug($this->nom). "/details");
    }

    public function pathUpdate() {
        return url("admin/sites/{$this->id}". Str::slug($this->nom). "/update-processing");
    }
}
