<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hmi extends Model
{
    use HasFactory;
    protected $table = 'hmi';
    protected $guarded = ['id'];
    // protected $fillable = [
    //     'machine_name',
    // ];
    public function shift()
    {
        return $this->belongsTo(Shift::class, 'shift_id', 'id');
    }
    public function line()
    {
        return $this->belongsTo(Line::class, 'line_id', 'id');
    }
    public function sku()
    {
        return $this->belongsTo(Sku::class, 'sku_id', 'id');
    }
    public function machine()
    {
        return $this->belongsTo(Machine::class, 'machine_id', 'id');
    }
    public function pic()
    {
        return $this->belongsTo(Pic::class, 'pic_id', 'id');
    }
}
