<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $blogs = Blog::latest()->get();
        return view('blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        Blog::create([
            'title' => $request->title,
            'content' => $request->content,
            'corrected_content' => $request->corrected_content,
        ]);

        return redirect()->route('blogs.index')->with('success', 'Blog berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        //
        return view('blogs.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        //
        $blog->update($request->only('title', 'content', 'corrected_content'));
        return redirect()->route('blogs.index')->with('success', 'Blog berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        //
    }

    public function correct(Request $request)
    {
        //
        $response = Http::post('http://localhost:5000/correct', [
            'text' => $request->input('content')
        ]);

        return response()->json($response->json());
    }
}
