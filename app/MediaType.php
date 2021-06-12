<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MediaType extends Model
{
    protected $connection = 'mysql_new';
    protected $table = 'media_types';
}
