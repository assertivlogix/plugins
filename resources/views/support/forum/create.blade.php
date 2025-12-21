@extends('layouts.frontend')

@section('title', 'Create New Topic - Assertivlogix')

@section('content')
<div class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-5">
                        <h1 class="mb-4">Create New Topic</h1>
                        
                        <form action="{{ route('support.forum.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label">Topic Title</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                                <div class="form-text">Choose a clear, descriptive title for your question or discussion.</div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="category_id" class="form-label">Category</label>
                                <select class="form-select" id="category_id" name="category_id" required>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="mb-4">
                                <label for="content" class="form-label">Content</label>
                                <textarea class="form-control" id="content" name="content" rows="8" required></textarea>
                            </div>
                            
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('support.forum') }}" class="btn btn-outline-secondary">Cancel</a>
                                <button type="submit" class="btn btn-primary px-4">Create Topic</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
