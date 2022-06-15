<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Team extends Model
{
    protected $guarded = ['id'];

    public function pathShow() {
        return url("admin/equipe/membre/{$this->id}-" . Str::slug($this->nom . " " . $this->poste) . "/details");
    }

    public function pathUpdate() {
        return url("admin/equipe/membre/{$this->id}-" . Str::slug($this->nom . " " . $this->poste) .  "/update");
    }
}
