<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Builder, Model, SoftDeletes};

/**
 * Category
 *
 * @method static \Database\Factories\CategoryFactory factory($count = null, $state = [])
 * @method static Builder|Category newModelQuery()
 * @method static Builder|Category newQuery()
 * @method static Builder|Category query()
 * @mixin Eloquent
 */
class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name'];
}
