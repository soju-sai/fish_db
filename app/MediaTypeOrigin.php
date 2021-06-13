<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MediaTypeOrigin extends Model
{
    protected $connection = 'mysql';
    protected $table = 'media_type';
    protected $primaryKey = 'type_id';
}
