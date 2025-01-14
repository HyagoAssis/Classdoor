<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Relations\BelongsTo, SoftDeletes};

/**
 * @property int $id
 * @property int $value
 * @property string|null $comment
 * @property int $classifiable_item_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 *
 * @method static \Database\Factories\ClassificationFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Classification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Classification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Classification onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Classification query()
 * @method static \Illuminate\Database\Eloquent\Builder|Classification whereClassifiableItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classification whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classification whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classification whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classification whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classification whereValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classification withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Classification withoutTrashed()
 *
 * @mixin \Eloquent
 */
class Classification extends BaseModel
{
    use HasFactory;
    use softDeletes;

    protected $fillable = ['value', 'comment', 'classifiable_item_id'];

    //region relations
    public function classifiableItem(): BelongsTo
    {
        return $this->belongsTo(ClassifiableItem::class);
    }

    //endregion
}
