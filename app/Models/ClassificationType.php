<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{SoftDeletes};

/**
 *
 *
 * @method static \Database\Factories\ClassificationTypeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|ClassificationType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClassificationType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClassificationType onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ClassificationType query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClassificationType withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ClassificationType withoutTrashed()
 * @property mixed $id
 * @property mixed $name
 * @property mixed $created_at
 * @property mixed $updated_at
 * @property mixed $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|ClassificationType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClassificationType whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClassificationType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClassificationType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClassificationType whereUpdatedAt($value)
 * @mixin Eloquent
 */
class ClassificationType extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name'];
}
