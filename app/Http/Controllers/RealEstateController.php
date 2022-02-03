<?php

namespace App\Http\Controllers;

use App\Http\Requests\RealEstateRequest;
use App\Models\RealEstate;

class RealEstateController extends Controller
{

    public function index()
    {
        $show_column =
            [
                'id',
                'name',
                'real_estate_type',
                'city','country'
            ];
        return RealEstate::latest()->get($show_column);
    }

    public function store(RealEstateRequest $req)
    {
        return RealEstate::create($req->all());
    }

    public function update(RealEstateRequest $req, $id)
    {
        RealEstate::find($id)->update($req->all());
        return RealEstate::find($id);
    }

    public function show($id)
    {
        return RealEstate::find($id);
    }

    public function destroy($id)
    {
        RealEstate::find($id)->delete();
        return  RealEstate::onlyTrashed()->find($id);
    }
}
