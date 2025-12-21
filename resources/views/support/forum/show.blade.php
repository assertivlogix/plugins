@extends('layouts.frontend')

@section('title', $topic->title . ' - Assertivlogix Forum')

@section('content')
<div class="py-5 bg-light">
    <div class="container">
        <div class="mb-4">
            <a href="{{ route('support.forum') }}" class="text-decoration-none text-muted"><i class="fas fa-arrow-left me-1"></i> Back to Forum</a>
        </div>
        
        <div class="row">
            <div class="col-lg-9">
                <!-- Topic Header -->
                <div class="mb-4">
                    <h1 class="mb-2">
                        @if($topic->is_pinned) <i class="fas fa-thumbtack me-2 text-danger"></i> @endif
                        {{ $topic->title }}
                    </h1>
                    <div class="text-muted">
                        <span class="badge me-2" style="background-color: {{ $topic->category->color ?? '#6c757d' }};">{{ $topic->category->name ?? 'General' }}</span>
                        <span>Posted {{ $topic->created_at->diffForHumans() }} by <strong>{{ $topic->user->name ?? 'Unknown' }}</strong></span>
                    </div>
                </div>
                
                <!-- Posts -->
                @forelse($topic->posts as $post)
                <div class="card border-0 shadow-sm mb-3 {{ $loop->first ? 'border-top-primary' : '' }}">
                    <div class="card-body p-4">
                        <div class="d-flex mb-3">
                            <div class="flex-shrink-0">
                                <div class="avatar bg-light text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; font-weight: bold; font-size: 1.2rem;">
                                    {{ substr($post->user->name ?? 'U', 0, 1) }}
                                </div>
                            </div>
                            <div class="ms-3 flex-grow-1">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">{{ $post->user->name ?? 'Unknown User' }}</h5>
                                    <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                                </div>
                                <div class="text-muted small">{{ isset($post->user->is_admin) && $post->user->is_admin ? 'Admin' : 'Member' }}</div>
                            </div>
                        </div>
                        
                        <div class="post-content">
                            {!! nl2br(e($post->content)) !!}
                        </div>
                    </div>
                </div>
                @empty
                    <p>No posts found.</p>
                @endforelse
                
                <!-- Reply Form -->
                @auth
                <div class="card border-0 shadow-sm mt-5">
                    <div class="card-body p-4">
                        <h4 class="mb-3">Leave a Reply</h4>
                        <form action="{{ route('support.forum.reply', $topic->slug) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <textarea class="form-control" name="content" rows="4" required placeholder="Type your reply here..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Post Reply</button>
                        </form>
                    </div>
                </div>
                @else
                <div class="alert alert-info mt-5 text-center">
                    Please <a href="{{ route('login') }}">login</a> to reply to this topic.
                </div>
                @endauth
            </div>
            
            <div class="col-lg-3">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Topic Info</h5>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><i class="fas fa-eye me-2 text-muted"></i> {{ $topic->views_count }} Views</li>
                            <li class="mb-2"><i class="fas fa-comment me-2 text-muted"></i> {{ $topic->posts->count() }} Replies</li>
                            <li class="mb-2"><i class="fas fa-calendar me-2 text-muted"></i> Created {{ $topic->created_at->format('M d, Y') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.border-top-primary {
    border-top: 4px solid #3b82f6 !important;
}
</style>
@endsection
