<?php

use App\Models\{Category, User};
use Laravel\Sanctum\Sanctum;

use function Pest\Laravel\{ assertSoftDeleted, deleteJson};

it('it should be able to delete a category with soft delete', function () {
    $user     = User::factory()->admin()->create();
    $category = Category::factory()->create();

    Sanctum::actingAs($user);

    deleteJson(route('categories.delete', $category))->assertOk();

    assertSoftDeleted('categories', ['id' => $category->id]);
});

test('only admin user should be able to delete a category', function () {
    $user     = User::factory()->regularUser()->create();
    $category = Category::factory()->create();

    Sanctum::actingAs($user);

    deleteJson(route('categories.delete', $category))->assertUnauthorized();
});
