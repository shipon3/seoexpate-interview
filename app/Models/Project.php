<?php

namespace App\Models;

use App\Enum\ProjectStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'user_id',
        'image',
        'description',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'status' => ProjectStatus::class,
        ];
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
