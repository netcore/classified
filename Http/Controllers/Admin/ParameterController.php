<?php

namespace Modules\Classified\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Category\Models\Category;
use Modules\Classified\Http\Requests\ParametersRequest;
use Modules\Classified\Models\Parameter;
use Modules\Classified\Models\ParameterAttribute;
use Netcore\Translator\Helpers\TransHelper;
use Nwidart\Modules\Facades\Module;

class ParameterController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $parameters = Parameter::with('attributes')->get();
        $languages = TransHelper::getAllLanguages();
        return view('classified::parameters.index', compact('parameters', 'languages'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('classified::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('classified::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param Parameter $parameter
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Parameter $parameter)
    {
        $categories = null;
        $attachCategories = config('netcore.module-classified.parameters.attach_to_categories');

        if($attachCategories) {
            $categories = Category::where('parent_id', null)->get();
        }

        return view('classified::parameters.edit', compact('parameter', 'attachCategories', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     * @param ParametersRequest $request
     * @param Parameter $parameter
     * @return
     */
    public function update(ParametersRequest $request, Parameter $parameter)
    {
        $request->merge([
            'is_active' => $request->has('is_active')
        ]);

        $parameter->updateTranslations(
            $request->input('translations', [])
        );

        if(config('netcore.module-classified.parameters.attach_to_categories')) {
            //update categories
            $categories = $request->get('categories', []);
            $parameter->categories()->sync($categories);
        }



        return redirect()->back()->withSuccess('Parameter successfully edited!');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }

    /**
     * @param Request $request
     * @param Parameter $parameter
     * @return array
     */
    public function updateAttribute(Request $request, Parameter $parameter)
    {

        $field = $request->get('name');
        $values = explode(':', $field); // ['name', 'lv']

        $attribute = ParameterAttribute::find($request->get('pk'));
        // Translation attribute/single param
        if(count($values) == 2) {
            $attribute->translateOrNew($values[1])->{$values[0]} = $request->get('value');
        } else {
            $attribute->{$values[0]} = $request->get('value');
        }

        $attribute->save();



        return [
            'state' => 'success'
        ];
    }

    /**
     * @param ParameterAttribute $attribute
     * @return array
     */
    public function destroyAttribute(ParameterAttribute $attribute)
    {
        $attribute->delete();

        return [
            'state' => 'success'
        ];
    }
}
