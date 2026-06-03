<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = \App\Models\News::where('published_at', '<=', now())
            ->orWhereNull('published_at')
            ->orderBy('created_at', 'desc')
            ->paginate(12);
            
        return view('student.news.index', compact('news'));
    }

    public function show(\App\Models\News $news)
    {
        return view('student.news.show', compact('news'));
    }
}
