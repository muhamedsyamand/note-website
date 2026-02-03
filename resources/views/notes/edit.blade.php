@extends('layouts.app')

@section('content')
    <h1 class="text-2xl sm:text-3xl font-bold mb-4">Edit Note</h1>

    <div class="paper-frame">
      <div class="paper px-3 sm:px-6">
        <div class="relative text-center py-2 sm:py-3">
          <div class="hidden sm:block absolute left-4 md:left-8 top-1/2 transform -translate-y-1/2 text-lg md:text-2xl font-bold text-gray-800">محامي</div>
          <img src="{{ asset('img/lawlogo.png') }}" alt="Logo" class="max-h-20 sm:max-h-24 md:max-h-28 mx-auto">
          <div class="hidden sm:block absolute right-4 md:right-8 top-1/2 transform -translate-y-1/2 text-lg md:text-2xl font-bold text-gray-800">پارێزەر</div>
        </div>
        <div class="text-left text-xs sm:text-sm text-red-600 border-2 border-red-600 rounded-lg inline-block p-2 sm:p-3 m-2 sm:m-3">Note ID: #{{ $note->id }}</div>
        <div class="overflow-x-auto">
          <table class="w-full border-collapse text-xs sm:text-sm whitespace-nowrap responsive-three-col table-fixed">
            <thead>
              <tr>
                <th class="col-content text-left p-2 sm:p-3">Contact</th>
                <th class="col-price text-right p-2 sm:p-3">Phone</th>
              </tr>
            </thead>
            <tbody>
            <tr>
              <td class="col-content text-left text-gray-800 p-2 sm:p-3 w-1/2">
                <strong>muhamed.syamand2003@gmail.com</strong>
              </td>
              <td class="col-price text-right text-gray-800 p-2 sm:p-3 w-1/2">
                <strong>07517182868</strong>
              </td>
            </tr>
            </tbody>
          </table>
        </div>
        <form id="edit-note-form" method="POST" action="{{ route('notes.update', $note) }}" class="is-paper-form">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label text-xs sm:text-sm">بەرواری</label>
                <input type="date" name="note_date" value="{{ old('note_date', $note->note_date?->format('Y-m-d')) }}" class="form-control w-full sm:max-w-xs">
            </div>

            <div class="mb-3">
                <label class="form-label text-xs sm:text-sm">ژمارەی تێلەفۆن</label>
                <input type="tel" name="phone_number" value="{{ old('phone_number', $note->phone_number) }}" class="form-control w-full sm:max-w-xs">
            </div>

            <div class="mb-3">
                <label class="form-label text-xs sm:text-sm">ناوی فرۆشیار</label>
                <input type="text" name="seller_name" value="{{ old('seller_name', $note->seller_name) }}" class="form-control w-full">
            </div>

            <div class="mb-3">
                <label class="form-label text-xs sm:text-sm">شتی تر</label>
                <input type="text" name="other_things" value="{{ old('other_things', $note->other_things ?? '') }}" class="form-control w-full">
            </div>

            <div class="mb-3">
                <label class="form-label text-xs sm:text-sm">ناونیشان</label>
                <input id="note-title" name="title" value="{{ old('title', $note->title) }}" class="form-control w-full @error('title') is-invalid @enderror note-title">
                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">ڕوونکردنەوە</label>
                <div class="note-input-wrapper">
                  <div class="note-line-wrapper">
                    <div id="line-numbers-edit" class="note-line-numbers" aria-hidden="true"></div>
                  </div>
                  <div id="note-body-container" class="note-body-container"></div>
                  <div class="note-numbers-wrapper">
                    <small class="text-muted note-numbers-label">پارە بە دینار</small>
                    <div id="note-numbers-container" class="note-numbers-column"></div>
                    <input type="hidden" name="numbers" id="numbers-hidden" value="{{ old('numbers', $note->numbers) }}">
                  </div>
                </div>
                <div class="note-footer">
                  <div class="note-footer-left"></div>
                  <div class="note-footer-center">
                    <strong class="edit-total-label">کۆی گشتی: <span id="edit-total">0</span></strong>
                  </div>
                  <div class="note-footer-right"></div>
                </div>
                <input type="hidden" name="body" id="body-hidden" value="{{ old('body', $note->body) }}">
            </div>

            <div class="flex flex-col sm:flex-row gap-2 sm:gap-3">
              <button class="btn btn-primary w-full sm:w-auto">Update</button>
              <a href="{{ route('notes.show', $note) }}" class="btn btn-link w-full sm:w-auto text-center">Cancel</a>
            </div>
        </form>
      </div>
    </div>

    <div class="summation-section mt-4 px-3 sm:px-6 text-xs sm:text-sm">
      <strong>Total:</strong> <span id="summation"></span>
    </div>

@endsection