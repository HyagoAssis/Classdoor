<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{SoftDeletes};

/**
 * @property int $id
 * @property string $name
 * @property int $classification_type_id
 * @property int $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 *
 * @method static \Database\Factories\ClassifiableItemFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|ClassifiableItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClassifiableItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClassifiableItem onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ClassifiableItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClassifiableItem whereClassificationTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClassifiableItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClassifiableItem whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClassifiableItem whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClassifiableItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClassifiableItem whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClassifiableItem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClassifiableItem withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ClassifiableItem withoutTrashed()
 *
 * @mixin \Eloquent
 */
class ClassifiableItem extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'classifiable_items';

    protected $fillable = ['name', 'classification_type_id', 'created_by', 'created_at', 'updated_at'];
}
