<?php

use App\Models\{Category, User};
use Laravel\Sanctum\Sanctum;

use function Pest\Laravel\getJson;

it('should be able to list categories', function () {
    Sanctum::actingAs(User::factory()->admin()->create());

    $category = Category::factory()->create();

    $request = getJson(route('categories.index'))
        ->assertOk();

    $request->assertJsonFragment([
        'id'         => $category->id,
        'name'       => $category->name,
        'created_at' => $category->created_at,
        'updated_at' => $category->updated_at,
        'deleted_at' => $category->deleted_at,
    ]);
});

test('only admin should be able to list categories', function () {
    Sanctum::actingAs(User::factory()->regularUser()->create());

    Category::factory()->create();

    getJson(route('categories.index'))
        ->assertUnauthorized();
});
