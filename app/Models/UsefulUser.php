<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $user_id
 * @property int $classification_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Classification $classification
 * @property-read \App\Models\User $user
 *
 * @method static \Database\Factories\UsefulUserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|UsefulUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UsefulUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UsefulUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|UsefulUser whereClassificationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UsefulUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UsefulUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UsefulUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UsefulUser whereUserId($value)
 *
 * @mixin \Eloquent
 */
class UsefulUser extends BaseModel
{
    use HasFactory;

    protected $fillable = ['user_id', 'classification_id'];

    //region Relations
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function classification(): BelongsTo
    {
        return $this->belongsTo(Classification::class);
    }

    //endregion
}
