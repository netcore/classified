<?php

namespace Modules\Classified\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Classified\Models\Field;
use Modules\Classified\Models\Parameter;
use Modules\Classified\Models\ParameterAttribute;
use Netcore\Translator\Helpers\TransHelper;

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
        return view('classified::parameters.edit', compact('parameter'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
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
