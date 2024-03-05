<?php

namespace App\Http\Controllers;

use App\Http\Requests\FeaturesRequest;
use App\Models\Features;
use Illuminate\Http\Request;

class FeaturesController extends Controller
{
    function addFeature(FeaturesRequest $request)
    {
        $data = $request->all();
        $feature = Features::create($data);
        return response()->json('YOUR DATA ADDED SUCSESFULY');
    }

    function editFeature(FeaturesRequest $request, $id)
    {
        $data = $request->all();
        $feature = Features::findorfail($id);
        $feature->update(
            $data
        );
        return response()->json('YOUR FEATURE EDITED SUCSESFULY');
    }

    function deleteFeature($id)
    {
        $feature = Features::destroy($id);
        return response()->json('YOUR FEATURE DELETED SUCSESFULY');
    }

    function showFeatureById($id)
    {
        $feature = Features::findorfail($id);
        return response()->json($feature);
    }

    function showAllFeatures()
    {
        $features = Features::get();
        return response()->json($features);
    }
}
