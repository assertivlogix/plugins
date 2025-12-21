@extends('layouts.frontend')

@section('title', 'Community Forum - Assertivlogix')

@section('content')
<div class="py-5 bg-light">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Community Forum</h1>
            <a href="{{ route('support.forum.create') }}" class="btn btn-primary"><i class="fas fa-plus me-2"></i> New Topic</a>
        </div>
        
        <div class="row">
            <div class="col-lg-9">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" href="#">Recent</a>
                            </li>
                            <!-- We can add more tabs logic later -->
                        </ul>
                    </div>
                    <div class="list-group list-group-flush">
                        @forelse($recentTopics as $topic)
                        <a href="{{ route('support.forum.show', $topic->slug) }}" class="list-group-item list-group-item-action p-4">
                            <div class="d-flex w-100 justify-content-between align-items-center mb-1">
                                <h5 class="mb-1 text-primary">
                                    @if($topic->is_pinned) <i class="fas fa-thumbtack me-1 text-danger"></i> @endif
                                    {{ $topic->title }}
                                </h5>
                                <small class="text-muted">{{ $topic->created_at->diffForHumans() }}</small>
                            </div>
                            <p class="mb-1 text-muted">{{ Str::limit($topic->posts->first()->content, 150) }}</p>
                            <small class="text-muted">
                                <i class="fas fa-user me-1"></i> {{ $topic->user->name ?? 'Unknown' }} &bull; 
                                <i class="fas fa-comment me-1"></i> {{ $topic->posts->count() }} replies &bull; 
                                <span class="badge" style="background-color: {{ $topic->category->color ?? '#6c757d' }};">{{ $topic->category->name ?? 'General' }}</span>
                            </small>
                        </a>
                        @empty
                        <div class="p-4 text-center text-muted">
                            <i class="fas fa-comments fa-3x mb-3"></i>
                            <p>No topics found. Be the first to start a conversation!</p>
                        </div>
                        @endforelse
                    </div>
                </div>
                
                {{ $recentTopics->links() }}
            </div>
            
            <div class="col-lg-3">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Categories</h5>
                    </div>
                    <div class="list-group list-group-flush">
                        @foreach($categories as $category)
                        <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            {{ $category->name }}
                            <!-- We could add a count here later -->
                        </a>
                        @endforeach
                    </div>
                </div>
                
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                         <h5 class="card-title">Forum Rules</h5>
                         <p class="card-text small text-muted">Please be respectful and helpful. Read our community guidelines before posting.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
