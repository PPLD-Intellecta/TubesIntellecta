<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Forum;
use App\Models\Chat;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    /**
     * Display list of all forums.
     */
    public function index()
    {
        $forums = Forum::withCount('chats')
            ->with('user')
            ->latest()
            ->get();

        return view('student.forum', compact('forums'));
    }

    /**
     * Store a new forum topic.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        Forum::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('forum.index')->with('success', 'Topik diskusi berhasil dibuat!');
    }

    /**
     * Display a specific forum with its chat messages.
     */
    public function show(Forum $forum)
    {
        $forum->load(['user', 'chats.user']);

        return view('student.forum-show', compact('forum'));
    }

    /**
     * Store a new chat message in a forum.
     */
    public function storeChat(Forum $forum, Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:2000',
        ]);

        Chat::create([
            'message' => $request->message,
            'user_id' => auth()->id(),
            'forum_id' => $forum->id,
        ]);

        return redirect()->route('forum.show', $forum)->with('success', 'Pesan terkirim!');
    }
}