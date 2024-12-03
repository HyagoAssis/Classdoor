<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

/**
 * @method static \Database\Factories\ClassificationTypeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|ClassificationType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClassificationType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClassificationType onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ClassificationType query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClassificationType withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ClassificationType withoutTrashed()
 *
 * @mixin Eloquent
 *
 * @property mixed $id
 * @property mixed $name
 * @property mixed $created_at
 * @property mixed $updated_at
 * @property mixed $deleted_at
 */
class ClassificationType extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name'];
}
