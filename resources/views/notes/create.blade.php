@extends('layouts.app')

@section('content')
    <h1 class="mb-3 text-2xl text-sm-3xl">New Note</h1>

    <div class="paper-frame">
      <div class="paper">
        <form id="create-note-form" method="POST" action="{{ route('notes.store') }}" class="is-paper-form">
            @csrf

            <div class="mb-3">
                <label class="form-label">Title</label>
                <input id="note-title" name="title" value="{{ old('title') }}" class="form-control @error('title') is-invalid @enderror note-title" placeholder="Enter note title">
                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="d-flex flex-column flex-sm-row gap-2">
              <button class="btn btn-primary w-100 w-sm-auto">Create</button>
              <a href="{{ route('notes.index') }}" class="btn btn-link w-100 w-sm-auto text-center text-sm-start">Cancel</a>
            </div>
        </form>
      </div>
    </div>
@endsection