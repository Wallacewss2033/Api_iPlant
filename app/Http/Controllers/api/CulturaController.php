<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cultura;

class CulturaController extends Controller
{
   
    public function index()
    {
        return Cultura::all();
    }

    public function store(Request $request)
    {
        Cultura::create($request->all());
    }

    public function show($id)
    {
        return Cultura::findOrfail($id);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $cultura = Cultura::findOrfail($id);
        $cultura->update($request->all());
    }

    public function destroy($id)
    {
        $cultura = Cultura::findOrfail($id);
        $cultura->delete();
    }
}
