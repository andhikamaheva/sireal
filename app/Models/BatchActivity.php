<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BatchActivity extends Model
{
    //
    use SoftDeletes;
    protected $table      = 'batch_activities';
    protected $primaryKey = 'id';
    protected $fillable   = [ 'batch_id',
        'name',
        'start_at',
        'end_at',
        'type'
    ];
    public    $timestamps = true;
    protected $dates      = [ 'deleted_at' ];

    public function batches()
    {
        return $this->belongsTo('App\Models\Batch', 'batch_id');
    }
}
