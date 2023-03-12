<?php

namespace App\Http\Controllers;

use App\Models\RawMaterial;
use App\Models\RawMaterialRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RawMaterialRequestController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  function __construct()
  {
    $this->middleware('permission:raw-req-list', ['only' => ['index', 'show']]);
    $this->middleware('permission:raw-req-create', ['only' => ['create', 'store']]);
    $this->middleware('permission:raw-req-edit', ['only' => ['edit', 'update']]);
    $this->middleware('permission:raw-req-delete', ['only' => ['destroy']]);
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $request->validate([
      'material_name' => 'required',
      'material_type' => 'required',
      'material_quantity' => 'required|numeric',
    ]);

    $mat_id = RawMaterial::where('material_name', $request->material_name)->where('material_type', $request->material_type)->select('id')->first();

    $new_req = new RawMaterialRequest();

    $new_req->raw_material_id = $mat_id->id;
    $new_req->raw_material_quantity = $request->material_quantity;
    $new_req->requested_by = Auth::user()->id;

    $new_req->save();

    flash()->addSuccess('Requested created');

    return back();
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\RawMaterialRequest  $rawMaterialRequest
   * @return \Illuminate\Http\Response
   */
  public function show(RawMaterialRequest $rawMaterialRequest)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\RawMaterialRequest  $rawMaterialRequest
   * @return \Illuminate\Http\Response
   */
  public function edit(RawMaterialRequest $rawMaterialRequest)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\RawMaterialRequest  $rawMaterialRequest
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, RawMaterialRequest $rawMaterialRequest)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\RawMaterialRequest  $rawMaterialRequest
   * @return \Illuminate\Http\Response
   */
  public function destroy(RawMaterialRequest $rawMaterialRequest)
  {
    //
  }
}
