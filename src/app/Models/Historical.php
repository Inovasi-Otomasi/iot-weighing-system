<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historical extends Model
{
    use HasFactory;
    protected $table = 'historical_log';
    protected $with = ['shift', 'sku', 'machine', 'line', 'hmi'];
    protected $guarded = ['id'];
    public $timestamps = false;
    // protected $fillable = [
    //     'line_name',
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
    public function hmi()
    {
        return $this->belongsTo(Hmi::class, 'hmi_id', 'id');
    }
}
