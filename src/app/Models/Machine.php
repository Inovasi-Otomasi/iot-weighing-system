<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    use HasFactory;
    protected $table = 'machine';
    protected $fillable = [
        'machine_name',
        'line_id'
    ];
    public function line()
    {
        return $this->belongsTo(Line::class, 'line_id', 'id');
    }
}
