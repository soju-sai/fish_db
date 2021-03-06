<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $connection = 'mysql_new';
    protected $table = 'medias';
    protected $fillable = ['id', 'filename', 'fish_species_id', 'media_type_id', 'is_publish', 'author', 'author_e', 'data_update_date', 'record_location', 'top_depth', 'bottom_depth', 'photo_condition', 'remark', 'scientific_names', 'identifier', 'iden_date'];

    public function media_type()
    {
        return $this->belongsTo(MediaType::class, 'media_type_id');
    }
}
