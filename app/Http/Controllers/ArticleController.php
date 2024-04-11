<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::all();
        return view("articles.index",compact("articles"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("articles.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fileName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('article_image'), $fileName);
        
        $text = preg_replace("/^<p.*?>/", "",$request->description);
        $description = preg_replace("|</p>$|", "",$text);

        Article::create([
            "title" => $request->title,
            "description" => $description,
            "image" => $fileName,
        ]);

        return redirect(route("articles.index"));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        return view("articles.edit",compact("article"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $fileName = null;

        if($request->image){
            $image_path = public_path("article_image/$request->beforeimage");
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
            $fileName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('article_image'), $fileName);
        }

        $article->update([
            'title' => $request->title,
            "description" => $request->description,
            "image" => $fileName != null ? $fileName : $request->beforeimage
        ]);

        return redirect(route('articles.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $image_path = public_path("article_image/$article->video");
        if(File::exists($image_path)) {
            File::delete($image_path);
        }
        $article->delete();
        return back();
    }
}
