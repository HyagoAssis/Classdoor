<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel query()
 *
 * @mixin \Eloquent
 */
class BaseModel extends Model
{
    public static function table($alias = null): string
    {
        return static::getModel()->getTable() . (is_null($alias) ? '' : ' as ' . $alias);
    }

    public static function column($column, $alias = null): string
    {
        return (is_null($alias) ? static::table() : $alias) . '.' . $column;
    }
}
