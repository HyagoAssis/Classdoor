<?php

namespace App\Models;

use Database\Factories\ComplaintFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Builder, Relations\BelongsTo, SoftDeletes};

/**
 * @method static ComplaintFactory factory($count = null, $state = [])
 * @method static Builder|Complaint newModelQuery()
 * @method static Builder|Complaint newQuery()
 * @method static Builder|Complaint query()
 *
 * @mixin \Eloquent
 *
 * @property mixed $status
 * @property mixed $classification
 */
class Complaint extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    public const STATUS_IN_ANALYSIS = 1;
    public const STATUS_APPROVED    = 2;
    public const STATUS_REPROVED    = 3;

    protected $fillable = ['user_id', 'classification_id', 'complaint', 'status'];

    //region Relations
    public function classification(): BelongsTo
    {
        return $this->belongsTo(Classification::class);
    }

    //endregion
}
