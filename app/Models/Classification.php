<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Relations\BelongsTo, Relations\HasMany, SoftDeletes};

/**
 *
 *
 * @property int $id
 * @property int $value
 * @property string|null $comment
 * @property int $classifiable_item_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
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
 * @property-read \App\Models\ClassifiableItem $classifiableItem
 * @property int|mixed $useful_count
 * @property int $valid
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Complaint> $complaints
 * @property-read int|null $complaints_count
 * @property mixed|string $file
 * @method static \Illuminate\Database\Eloquent\Builder|Classification whereUsefulCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classification whereValid($value)
 * @mixin \Eloquent
 */
class Classification extends BaseModel
{
    use HasFactory;
    use softDeletes;

    protected $fillable = ['value', 'comment', 'classifiable_item_id', 'valid', 'useful_count', 'file'];

    //region relations
    public function classifiableItem(): BelongsTo
    {
        return $this->belongsTo(ClassifiableItem::class);
    }

    public function complaints(): HasMany
    {
        return $this->hasMany(Complaint::class);
    }

    //endregion
}
