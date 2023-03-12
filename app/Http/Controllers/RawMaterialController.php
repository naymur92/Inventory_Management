<?php

namespace App\Http\Controllers;

use App\Models\RawMaterial;
use Illuminate\Http\Request;

class RawMaterialController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $raw_materials = RawMaterial::orderBy('created_at', 'desc')->get();
    return view('pages.raw_materials.index', compact('raw_materials'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */

  //  create raw material request
  public function create()
  {
    $item_list = RawMaterial::select('material_name')->groupBy('material_name')->get();

    return view('pages.raw_materials.create', compact('item_list'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {

    $field_length = count($request->material_name);

    // check existing data and set errors
    $errors = [];
    for ($i = 0; $i < $field_length; $i++) {
      $item_exists = RawMaterial::where('material_name', $request->material_name[$i])->where('material_type', $request->material_type[$i])->get();

      if (count($item_exists) == 1) {
        $errors[] = "Duplicate Entry for {$request->material_name[$i]}({$request->material_type[$i]})";
      }
    }


    if (count($errors) == 0) {
      for ($i = 0; $i < $field_length; $i++) {
        $rawMaterial = new RawMaterial();

        $rawMaterial->material_name = trim($request->material_name[$i]);
        $rawMaterial->material_type = trim($request->material_type[$i]);
        $rawMaterial->material_quantity = 0;
        $rawMaterial->quantity_unit = trim($request->quantity_unit[$i]);

        $rawMaterial->save();
      }
    } else {
      return response()->json(['success' => false, 'errors' => $errors]);
    }

    if ($field_length == 1) {
      flash()->addSuccess('Item Added');
    } else {
      flash()->addSuccess('Items Added');
    }

    // return back();

    return response()->json(['success' => true]);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\RawMaterial  $rawMaterial
   * @return \Illuminate\Http\Response
   */
  public function show(RawMaterial $rawMaterial)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\RawMaterial  $rawMaterial
   * @return \Illuminate\Http\Response
   */
  public function edit(RawMaterial $rawMaterial)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\RawMaterial  $rawMaterial
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, RawMaterial $rawMaterial)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\RawMaterial  $rawMaterial
   * @return \Illuminate\Http\Response
   */
  public function destroy(RawMaterial $rawMaterial)
  {
    $rawMaterial->delete();

    flash()->addSuccess('Item Deleted');

    return back();
  }

  // get material item based on name
  public function get_item_types(Request $request)
  {
    $item_types = RawMaterial::where('material_name', $request->material_name)->select('material_type')->get();
    $unit = RawMaterial::where('material_name', $request->material_name)->select('quantity_unit')->first();
    return response()->json(['success' => true, 'types' => $item_types, 'unit' => $unit->quantity_unit]);
  }
}
