<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ComicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $comics = Comic::all();
        return view('comics.index')
            ->with('comics', $comics);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('comics.coe');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store()
    {
        $comic = new Comic;
        if($comic->validate(Input::all(), Comic::$rules)){
            $comic->title       = Input::get('title');
            $comic->description = Input::get('description');
            $comic->current     = Input::get('current');
            $comic->total       = Input::get('total');
            $comic->owned       = Input::get('owned');
            $comic->readed      = Input::get('readed');
            $comic->year        = Input::get('year');
            $comic->finished    = Input::get('finished');            
            $comic->save();
            return redirect('comics');
        }else{
            $errors = $comic->errors();
            return redirect()->back()->withInput()->withErrors($errors);
        }   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $comic = Comic::find($id);
        return view('comics.show')
            ->with('comic',$comic);
            
                            
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $comic = Comic::find($id);        
        return view('comics.coe')
            ->with('comic',$comic);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $comic = Comic::find($id);
        if($comic->validate(Input::all(), Comic::$rules)){
            $comic->title       = Input::get('title');
            $comic->description = Input::get('description');
            $comic->current     = Input::get('current');
            $comic->total       = Input::get('total');
            $comic->owned       = Input::get('owned');
            $comic->readed      = Input::get('readed');
            $comic->year        = Input::get('year');
            $comic->finished    = Input::get('finished'); 
            $comic->save();
            return redirect('comics');
        }else{
            $errors = $comic->errors();
            return redirect()->back()->withInput()->withErrors($errors);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $comic = Comic::find($id);
        $comic->delete();
        return redirect('comics');
    }
}
