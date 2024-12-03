<?php

use App\Models\{ClassificationType, User};

use Laravel\Sanctum\Sanctum;

use function Pest\Laravel\{assertSoftDeleted, deleteJson};

it('it should be able to delete a ClassificationType with soft delete', function () {
    $user               = User::factory()->admin()->create();
    $classificationType = ClassificationType::factory()->create();

    Sanctum::actingAs($user);

    deleteJson(route('classification_types.delete', $classificationType))->assertOk();

    assertSoftDeleted('classification_types', ['id' => $classificationType->id]);
});

test('only admin user should be able to delete a ClassificationType', function () {
    $user               = User::factory()->regularUser()->create();
    $classificationType = ClassificationType::factory()->create();

    Sanctum::actingAs($user);

    deleteJson(route('classification_types.delete', $classificationType))->assertUnauthorized();
});
