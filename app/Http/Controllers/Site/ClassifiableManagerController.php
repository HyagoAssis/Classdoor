<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\{ClassifiableItem, Classification, ClassificationType};
use Illuminate\Http\Request;
use Inertia\Inertia;

class ClassifiableManagerController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @throws \Exception
     */
    public function __invoke(Request $request, ?ClassifiableItem $classifiableItem): \Inertia\Response
    {
        $type = null;

        if ($classifiableItem->id) {
            $classifiableItem->load(['classificationType', 'classifications']);

            $classifiableItem->avg_classification   = round($classifiableItem->classifications()->avg(Classification::column('value')) ?? 0, 2);
            $classifiableItem->total_classification = $classifiableItem->classifications()->count();

            $type = $classifiableItem->classificationType;
        } else {
            switch ($request->get('type')) {
                case 'teacher':
                    $type = ClassificationType::find(1);

                    break;
                case 'discipline':
                    $type = ClassificationType::find(2);

                    break;
                case 'place':
                    $type = ClassificationType::find(3);

                    break;
            }
        }

        if (!$type) {
            return Inertia::render('Site/NotFound');
        }

        return Inertia::render('Site/ClassifiableManager', [
            'classifiableItem'   => $classifiableItem->id ? $classifiableItem : null,
            'classificationType' => $type,
        ]);
    }
}
