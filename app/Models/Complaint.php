<?php

namespace App\Models;

use Database\Factories\ComplaintFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Builder, Model, Relations\BelongsTo, SoftDeletes};

/**
 * @method static ComplaintFactory factory($count = null, $state = [])
 * @method static Builder|Complaint newModelQuery()
 * @method static Builder|Complaint newQuery()
 * @method static Builder|Complaint query()
 *
 * @mixin \Eloquent
 */
class Complaint extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['user_id', 'classification_id', 'complaint', 'status'];

    //region Relations
    public function classification(): BelongsTo
    {
        return $this->belongsTo(Classification::class);
    }

    //endregion
}
