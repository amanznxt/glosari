<?php

namespace App\Http\Controllers\Ajax\Dictionary\Word;

use App\Dictionary;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LexiconController extends Controller
{
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $word = Dictionary::with('lexicon')->where('id', request('id'))->first();

        if ($word->lexicon) {
            return response()->json(['lexicon' => $word->lexicon]);
        } else {
            return response()->json();
        }
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
    public function update(Request $request)
    {
        $this->validate($request, [
            'id'         => 'required',
            'lexicon_id' => 'required',
        ]);

        Dictionary::where('id', $request->input('id'))->update($request->except('_method', '_token'));

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Dictionary Lexicon Updated']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
