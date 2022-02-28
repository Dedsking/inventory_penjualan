<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Item::all();
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

        $this->validate($request, [
            'nama_item' => 'required|String|min:3',
            'stok' => 'required|Integer|min:1',
            'unit' => 'required|',
            'harga_satuan' => 'required|Integer|min:1',

        ]);

        return Item::create([
            'nama_item' => $request->nama_item,
            'stok' => $request->stok,
            'unit' => $request->unit,
            'harga_satuan' => $request->harga_satuan,
        ]);
        // dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_item' => 'required|String|min:3',
            'stok' => 'required|Integer|min:1',
            'unit' => 'required|',
            'harga_satuan' => 'required|Integer|min:1',

        ]);

        $dtitem = [
            'nama_item' => $request->nama_item,
            'stok' => $request->stok,
            'unit' => $request->unit,
            'harga_satuan' => $request->harga_satuan,
        ];

        $ubahData = Item::findOrFail($id);
        $ubahData->update($dtitem);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hapus = Item::findOrFail($id);
        $hapus->delete();
    }
}
