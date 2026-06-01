<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Forum;
use App\Models\Chat;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    /**
     * Display all forums for admin moderation.
     */
    public function index()
    {
        $forums = Forum::withCount('chats')
            ->with('user')
            ->latest()
            ->get();

        return view('admin.forum', compact('forums'));
    }

    /**
     * Delete a chat message (moderation).
     */
    public function destroyChat(Chat $chat)
    {
        $chat->delete();

        return back()->with('success', 'Pesan berhasil dihapus.');
    }

    /**
     * Delete a forum and all its chats.
     */
    public function destroyForum(Forum $forum)
    {
        $forum->delete();

        return redirect()->route('admin.forum.index')->with('success', 'Forum berhasil dihapus.');
    }
}
