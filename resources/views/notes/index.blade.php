@extends('layouts.app')

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center gap-2 mb-3">
        <h1 class="mb-2 mb-md-0">Notes</h1>
        <a href="{{ route('notes.create') }}" class="btn btn-primary w-100 w-md-auto">New Note</a>
    </div>

    <form method="GET" action="{{ route('notes.index') }}" class="mb-3">
        <div class="input-group">
            <input name="q" value="{{ request('q') }}" placeholder="Search notes by title or body" class="form-control" />
            <button class="btn btn-outline-secondary">Search</button>
        </div>
    </form>

    @if(request('q'))
        <p class="text-muted">Results for "{{ request('q') }}"</p>
    @endif

    @if($notes->count())
        <div class="list-group">
            @foreach($notes as $note)
                <a href="{{ route('notes.show', $note) }}" class="list-group-item list-group-item-action">
                    <div class="d-flex flex-column flex-sm-row w-100 justify-content-sm-between gap-2">
                        <h5 class="mb-1 mb-sm-0 text-break">{{ $note->title }}</h5>
                        <small class="text-nowrap">{{ $note->created_at->diffForHumans() }}</small>
                    </div>
                    <p class="mb-0 mt-2 text-break">{{ Str::limit($note->body, 120) }}</p>
                </a>
            @endforeach
        </div>

        <div class="mt-3 d-flex justify-content-center">{{ $notes->links() }}</div>
    @else
        <p>No notes yet. <a href="{{ route('notes.create') }}">Create one</a>.</p>
    @endif

@endsection