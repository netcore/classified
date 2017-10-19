<?php

namespace Modules\Classified\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Classified\Models\Field;
use Netcore\Translator\Helpers\TransHelper;

class FieldController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $fields = Field::with('attributes')->get();
        $languages = TransHelper::getAllLanguages();
        return view('classified::fields.index', compact('fields', 'languages'));
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
     * @return Response
     */
    public function edit(Field $field)
    {
        return view('classified::fields.edit', compact('field'));
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
}
