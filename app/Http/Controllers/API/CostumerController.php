<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Costumer;
use Illuminate\Http\Request;

class CostumerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Costumer::all();
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
            'nama' => 'required|String|min:3',
            'contact' => 'required|String',
            'email' => 'required',
            'alamat' => 'required',
            'diskon' => 'required',
            'tipe_diskon' => 'required',
        ]);

        return Costumer::create([
            'nama' => $request->nama,
            'contact' => $request->contact,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'diskon' => $request->diskon,
            'tipe_diskon' => $request->tipe_diskon,
        ]);
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
            'nama' => 'required|String|min:3',
            'contact' => 'required|String',
            'email' => 'required',
            'alamat' => 'required',
            'diskon' => 'required',
            'tipe_diskon' => 'required',
        ]);

        $dtcostumer = [
            'nama' => $request->nama,
            'contact' => $request->contact,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'diskon' => $request->diskon,
            'tipe_diskon' => $request->tipe_diskon,
        ];

        $ubahData = Costumer::findOrFail($id);
        $ubahData->update($dtcostumer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hapus = Costumer::findOrFail($id);
        $hapus->delete();
    }
}
