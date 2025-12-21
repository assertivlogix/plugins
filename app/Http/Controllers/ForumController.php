<?php

namespace App\Http\Controllers;

use App\Models\ForumCategory;
use App\Models\ForumTopic;
use App\Models\ForumPost;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth;

class ForumController extends Controller
{
    public function index()
    {
        $categories = ForumCategory::orderBy('order')->get();
        $recentTopics = ForumTopic::with(['user', 'category', 'posts'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('support.forum', compact('categories', 'recentTopics'));
    }

    public function create()
    {
        $categories = ForumCategory::orderBy('order')->get();
        return view('support.forum.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required|exists:forum_categories,id',
            'content' => 'required'
        ]);

        $topic = ForumTopic::create([
            'user_id' => Auth::id(),
            'forum_category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . uniqid(),
        ]);

        ForumPost::create([
            'forum_topic_id' => $topic->id,
            'user_id' => Auth::id(),
            'content' => $request->content
        ]);

        return redirect()->route('support.forum.show', $topic->slug)->with('success', 'Topic created successfully!');
    }

    public function show($slug)
    {
        $topic = ForumTopic::where('slug', $slug)->with(['user', 'posts.user', 'category'])->firstOrFail();
        $topic->increment('views_count');
        
        return view('support.forum.show', compact('topic'));
    }

    public function reply(Request $request, $slug)
    {
        $request->validate([
            'content' => 'required'
        ]);

        $topic = ForumTopic::where('slug', $slug)->firstOrFail();

        ForumPost::create([
            'forum_topic_id' => $topic->id,
            'user_id' => Auth::id(),
            'content' => $request->content
        ]);

        return redirect()->back()->with('success', 'Reply added successfully!');
    }
}
