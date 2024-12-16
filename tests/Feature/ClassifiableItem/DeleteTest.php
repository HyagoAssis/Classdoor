<?php

use App\Models\{ClassifiableItem, User};
use Laravel\Sanctum\Sanctum;

use function Pest\Laravel\{assertNotSoftDeleted, assertSoftDeleted, deleteJson};

it('it should be able to delete a ClassifiableItem with soft delete', function () {
    $user             = User::factory()->admin()->create();
    $classifiableItem = ClassifiableItem::factory()->create();

    Sanctum::actingAs($user);

    deleteJson(route('classifiable_items.delete', $classifiableItem))->assertOk();

    assertSoftDeleted('classifiable_items', ['id' => $classifiableItem->id]);
});

test('only admin user should be able to delete a ClassificationType', function () {
    $classifiableItem = ClassifiableItem::factory()->create();

    deleteJson(route('classifiable_items.delete', $classifiableItem))->assertUnauthorized();

    assertNotSoftDeleted('classifiable_items', ['id' => $classifiableItem->id]);
});
