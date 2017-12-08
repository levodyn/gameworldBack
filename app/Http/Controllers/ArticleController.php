<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

class ArticleController extends Controller
{
    public function index()
    {
        $article = Article::with('user')->orderBy('created_at', 'DESC')->get();
        return response()->json($article,200);
    }

    public function show($id)
    {
       $result = $article = Article::with('user')->find($id);        
       return response()->json($result,200);
    }

    public function store(Request $request)
    {
        $article = Article::create($request->all());

        return response()->json($article, 201);
    }

    public function storeImage(Request $request){
        $name = 'image';
        if($request->hasFile($name))
		{
            //upload image
            $fileNameToStore = $request->input('fileName');            
			$path = $request -> file($name)->storeAs('public/uploads/articles/', $fileNameToStore); 
		}else
		{
			return response()->json('Image not stored', 400);
		}
		
		return response()->json('Image stored', 200);
    }

    public function update(Request $request, Article $article)
    {
        $article->update($request->all());

        return response()->json($article, 200);
    }

    public function destroy($id)
    {
        Article::find($id)->delete();

        return response()->json("article deleted", 204);
    }
}
