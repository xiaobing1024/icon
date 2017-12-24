<?php

namespace App\Http\Models;

/**
 * Class Icon
 * @package App\Http\Models
 *
 * @property int $width
 * @property int $height
 * @property-read array $path_info
 */
class Icon extends Model
{
    public $timestamps = false;

    public function type()
    {
        return $this->belongsTo(Type::class, 'type', 'id');
    }

    public function getPathInfoAttribute()
    {
//        return $this->getRelationValue('type')->name . '/' .
//            $this->getAttributeValue('name') . '.png';
        return pathinfo($this->getRelationValue('type')->name . '/' .
            $this->getAttributeValue('name') . '.png');
    }
}
