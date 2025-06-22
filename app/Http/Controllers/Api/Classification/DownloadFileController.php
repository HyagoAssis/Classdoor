<?php

namespace App\Http\Controllers\Api\Classification;

use App\Http\Controllers\Controller;
use App\Models\Classification;
use Illuminate\Support\Facades\Storage;

class DownloadFileController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Classification $classification)
    {
        $fileName = 'classification_files/' . $classification->getId() . '_' . $classification->file;

        if (!\Storage::disk('public')->exists($fileName)) {
            abort(404, 'Arquivo não encontrado');
        }

        $url = Storage::disk('public')->url($fileName);

        return response()->json(['url' => $url]);
    }
}
