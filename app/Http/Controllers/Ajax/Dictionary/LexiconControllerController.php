<?php

namespace App\Http\Controllers\Ajax\Dictionary;

use App\Lexicon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LexiconControllerController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lexicons = Lexicon::orderBy('created_at', 'desc')->paginate(25);
        return view('lexicons.index', ['resources' => $lexicons, 'route' => 'lexicons']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('lexicons.form', ['type' => 'POST']);
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
        Lexicon::create($request->all());
        flash('Resource successfully created', 'success');
        return redirect()->route('lexicons.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lexicon = Lexicon::find($id);
        return view('lexicons.show', ['resource' => $lexicon]);
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
        $lexicon = Lexicon::find($id);
        return view('lexicons.form', ['type' => 'PUT', 'resource' => $lexicon]);
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
        Lexicon::where('id', $id)->update($request->except('_method','_token'));
        flash('Resource successfully updated', 'success');
        return redirect()->route('lexicons.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Lexicon::destroy($id);
        flash('Resource successfully destroyed', 'success');
        return redirect()->route('lexicons.index');
    }
}
