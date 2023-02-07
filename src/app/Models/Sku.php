<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sku extends Model
{
    use HasFactory;
    protected $table = 'sku';
    protected $fillable = [
        'sku_name',
        'line_id',
        'target',
        'th_H',
        'th_L'
    ];
    public function line()
    {
        return $this->belongsTo(Line::class, 'line_id', 'id');
    }
}
