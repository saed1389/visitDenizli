<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Festival;
use App\Models\HistoryPlace;
use App\Models\Housing;
use App\Models\MuseumPlace;
use App\Models\NaturalPlace;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function image(Request $request)
    {
        $type = $request->get('type');
        $id = $request->get('id');

        $modelMap = [
            'event' => Event::class,
            'housing' => Housing::class,
            'festival' => Festival::class,
            'history' => HistoryPlace::class,
            'museum' => MuseumPlace::class,
            'natural' => NaturalPlace::class,
        ];

        if (!isset($modelMap[$type])) {
            return response()->json(['image' => asset('front/assets/images/default-location.png')]);
        }

        $record = $modelMap[$type]::find($id);
        $image = $record && $record->image
            ? asset($record->image)
            : asset('front/assets/images/default-location.png');

        return response()->json(['image' => $image]);
    }
}
