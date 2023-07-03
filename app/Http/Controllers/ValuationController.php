<?php

namespace App\Http\Controllers;

use App\Models\Valuation;
use Illuminate\Http\Request;

class ValuationController extends Controller
{
    public function index()
    {
        $valuations =Valuation::all();

        return view('valuation.index',['valuations' => $valuations]);
    }

    public function create()
    {
        return view('valuation.create');
    }

    public function store(Request $request)
    {
        $valuation = new Valuation;

        $valuation->name=$request->name;
        $valuation->value=$request->value;

        $valuation->save();

        return $this->index();
    }

    public function edit($id)
    {
        $valuation = Valuation::find($id);

        return view('valuation.edit',['valuation' => $valuation]);
    }

    public function update(Request $request)
    {
        $valuation = Valuation::find($request->valuation_id);

        $valuation->name = $request->name;
        $valuation->value = $request->value;

        $valuation->save();

        return $this->index();
    }
}
