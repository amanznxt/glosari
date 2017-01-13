<?php

namespace App\Http\Controllers;

use App\Dictionary;
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
        $dictionaries = Dictionary::orderBy('created_at', 'desc')->paginate(25);
        $lexicons = Lexicon::whereNull('parent_id')->orderby('name')->get();
        $totalSet = Dictionary::whereNotNull('lexicon_id')->get()->count();
        $totalNotSet = Dictionary::whereNull('lexicon_id')->get()->count();
        return view('dictionaries.index', [
            'resources' => $dictionaries,
            'route' => 'dictionaries',
            'lexicons' => $lexicons,
            'totalSet' => $totalSet,
            'totalNotSet' => $totalNotSet,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lexicons = Lexicon::whereNull('parent_id')->orderby('name')->get();
        return view('dictionaries.form', ['type' => 'POST', 'lexicons' => $lexicons]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'name' => 'required|min:3|max:255',
        // ]);
        Dictionary::create($request->all());
        flash('Resource successfully created', 'success');
        return redirect()->route('dictionaries.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dictionary = Dictionary::find($id);
        return view('dictionaries.show', ['resource' => $dictionary]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $type = 'PUT';
        $dictionary = Dictionary::find($id);
        $lexicons = Lexicon::whereNull('parent_id')->orderby('name')->get();
        return view('dictionaries.form', ['type' => 'PUT', 'resource' => $dictionary, 'lexicons' => $lexicons]);
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
        // $this->validate($request, [
        //     'name' => 'required|min:3|max:255',
        // ]);
        Dictionary::where('id', $id)->update($request->except('_method', '_token'));

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Dictionary updated']);
        }

        flash('Resource successfully updated', 'success');
        return redirect()->route('dictionaries.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function setWordLexicon(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
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
        Dictionary::destroy($id);
        flash('Resource successfully destroyed', 'success');
        return redirect()->route('dictionaries.index');
    }
}
