<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\{ClassifiableItem, ClassificationType};
use Illuminate\Http\Request;
use Inertia\Inertia;

class ClassifiableManagerController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, ClassifiableItem $classifiableItem): \Inertia\Response
    {
        $type = null;

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

        if (!$type) {
            return redirect('/');
        }

        if ($classifiableItem->exists) {
            $classifiableItem->load('classificationType');

        }

        return Inertia::render('Site/ClassifiableManager', [
            'classifiableItem'   => $classifiableItem->id ? $classifiableItem : null,
            'classificationType' => $type,
        ]);
    }
}
