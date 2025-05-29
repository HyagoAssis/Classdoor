<?php

namespace App\Models;

use Database\Factories\ComplaintFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Builder, Relations\BelongsTo, SoftDeletes};

/**
 *
 *
 * @method static ComplaintFactory factory($count = null, $state = [])
 * @method static Builder|Complaint newModelQuery()
 * @method static Builder|Complaint newQuery()
 * @method static Builder|Complaint query()
 * @property mixed $status
 * @property mixed $classification
 * @property int $id
 * @property string|null $complaint
 * @property int $classification_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static Builder|Complaint onlyTrashed()
 * @method static Builder|Complaint whereClassificationId($value)
 * @method static Builder|Complaint whereComplaint($value)
 * @method static Builder|Complaint whereCreatedAt($value)
 * @method static Builder|Complaint whereDeletedAt($value)
 * @method static Builder|Complaint whereId($value)
 * @method static Builder|Complaint whereStatus($value)
 * @method static Builder|Complaint whereUpdatedAt($value)
 * @method static Builder|Complaint whereUserId($value)
 * @method static Builder|Complaint withTrashed()
 * @method static Builder|Complaint withoutTrashed()
 * @mixin \Eloquent
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
