<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();

        return view('admin.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|min:3'
            ]
        );

        $data = $request->all();

        //creazione dello slug 
        $slug = Str::of($data['name'])->slug('-');

        $counter = 1;
        while(Tag::where('slug', $slug)->first()){

            $slug = Str::of($data['name'])->slug('-') .'-'. $counter;
            $counter++;
        }

        $data['slug'] = $slug;

        $tag = new Tag();
        $tag->fill($data);
        $tag->save();
        return redirect()->route('admin.tags.show', ['tag' => $tag->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        return view ('admin.tags.show', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        return view('admin.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $request->validate(
            [
                'name' => 'required|min:3'
            ]
        );

        $data = $request->all();

        //creazione dello slug 
        $slug = Str::of($data['name'])->slug('-');

        if($tag->slug != $slug){
            $counter = 1;

            while(Tag::where('slug', $slug)->first()){

                $slug = Str::of($data['title'])->slug('-') .'-'. $counter;
                $counter++;
            }

            $data['slug'] = $slug;
        }

        $tag->update($data);
        $tag->save();
        return redirect()->route('admin.tags.show', ['tag' => $tag->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('admin.tags.index');
    }
}
