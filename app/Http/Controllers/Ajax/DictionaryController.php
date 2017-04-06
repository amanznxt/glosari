<?php

namespace App\Http\Controllers\Ajax;

use App\Dictionary;
use App\Http\Controllers\Controller;
use App\Lexicon;
use Illuminate\Http\Request;

class DictionaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lexicons = Lexicon::orderBy('name')->get();
        $data     = Dictionary::orderBy('name')->get()->map(function ($datum) use ($lexicons) {
            return [
                $datum->name,
                $this->renderActions($datum),
            ];
        });
        return response()->json(compact('data'), 200);
    }

    private function renderActions($datum)
    {
        return view('components.link-modal')
            ->with('name', $datum->name)
            ->with('dictionary', $datum->id)
            ->with('toggle', 'edit-dictionary-modal')
            ->with('label', 'Details')
            ->render();
    }

    private function renderLexicon($lexicons, $datum)
    {
        return view('components.forms.dropdowns-dictionary', [
            'name'     => 'dictionary_id_' . $datum->id,
            'label'    => '',
            'options'  => $lexicons,
            'resource' => $datum,
            'selected' => ($datum->lexicon) ? $datum->lexicon->id : null]
        )->render();
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
        //
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
