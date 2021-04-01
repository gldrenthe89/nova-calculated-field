<?php
namespace Gldrenthe89\NovaCalculatedField\Http\Controllers;

use Illuminate\Routing\Controller;
use Laravel\Nova\Http\Requests\NovaRequest;


class CalculatedFieldController extends Controller
{
    public function calculate($resource, $fieldName, NovaRequest $request)
    {
        $field = $request->newResource()
            ->availableFields($request)
            ->whereNotNull('calculateFunction')
            ->where('showOnCreation', '=', true)
            ->where('attribute', '=', $fieldName)
            ->first();

        if (empty($field)) {
            $field = $request->newResource()
                ->availableFields($request)
                ->whereNotNull('calculateFunction')
                ->where('showOnUpdate', '=', true)
                ->where('attribute', '=', $fieldName)
                ->first();
        }

        if (empty($field)) {
            abort(404, "Unable to find the field required to calculate this value");
        }

        $calculatedValue = call_user_func(
            $field->calculateFunction,
            collect($request->json()->all()),
            $request
        );

        return response()->json([
            'disabled' => $field->disableOnUpdate,
            'value' => $calculatedValue
        ]);
    }
}
