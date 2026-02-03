@extends('layouts.app')

@section('content')
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-3 sm:gap-0 mb-3 px-2 sm:px-3 md:px-0">
        <div class="min-w-0 flex-1">
            <h1 class="text-lg sm:text-2xl md:text-3xl font-bold break-words leading-tight">{{ $note->title }}</h1>
            <p class="text-gray-600 text-xs sm:text-sm mt-1">{{ $note->created_at->toDayDateTimeString() }}</p>
        </div>
        <div class="flex flex-col xs:flex-row gap-2 w-full sm:w-auto shrink-0">
            <a href="{{ route('notes.edit', $note) }}" class="btn btn-outline-primary flex-1 xs:flex-none text-center text-xs sm:text-sm py-2 px-3">دەستکاری</a>
            <form action="{{ route('notes.destroy', $note) }}" method="POST" onsubmit="return confirm('سڕینەوەی ئەم نامەیە؟')" class="flex-1 xs:flex-none">
                @csrf
                @method('DELETE')
                <button class="btn btn-outline-danger w-full text-xs sm:text-sm py-2 px-3">سڕینەوە</button>
            </form>
        </div>
    </div>

    <div class="paper-frame px-2 sm:px-3 md:px-0">
      <div id="note-paper" class="paper px-3 sm:px-4 md:px-6">
        <div class="relative text-center py-2 sm:py-4">
          <div class="hidden sm:block absolute left-2 sm:left-4 md:left-8 top-1/2 transform -translate-y-1/2 text-sm sm:text-lg md:text-2xl font-bold text-gray-800">محامي</div>
          <img src="{{ asset('img/lawlogo.png') }}" alt="Logo" class="max-h-12 sm:max-h-20 md:max-h-24 lg:max-h-28 mx-auto">
          <div class="hidden sm:block absolute right-2 sm:right-4 md:right-8 top-1/2 transform -translate-y-1/2 text-sm sm:text-lg md:text-2xl font-bold text-gray-800">پارێزەر</div>
        </div>
        <div class="text-left text-xs border-2 border-red-600 rounded-lg inline-block p-2 sm:p-3 m-2 sm:m-3 bg-red-50 text-red-600">Note ID: #{{ $note->id }}</div>
        
        <!-- Responsive Table - Columns Side by Side -->
        <div class="overflow-x-auto w-full">
          <table class="w-full border-collapse text-xs sm:text-sm">
            <tbody>
            <tr class="flex flex-wrap border-b">
              <td class="w-1/2 p-2 sm:p-3 text-center">
                <div class="text-xs font-bold text-gray-600 mb-1">ئیمەیل</div>
                <span class="text-gray-800 break-words">muhamed.syamand2003@gmail.com</span>
              </td>
              <td class="w-1/2 p-2 sm:p-3 text-center border-l">
                <div class="text-xs font-bold text-gray-600 mb-1">تێلەفۆن</div>
                <span class="text-gray-800">07517182868</span>
              </td>
            </tr>
            <tr class="flex flex-wrap border-b">
              <td class="w-1/2 p-2 sm:p-3 text-center">
                <div class="text-xs font-bold text-gray-600 mb-1">شتی تر</div>
                <span class="text-gray-800 break-words">{{ $note->other_things ?? 'شتی تر نیە' }}</span>
              </td>
              <td class="w-1/2 p-2 sm:p-3 text-center border-l">
                <div class="text-xs font-bold text-gray-600 mb-1">بەرواری</div>
                <span class="text-gray-800">{{ $note->note_date?->format('Y-m-d') ?? 'بەرواری نیە' }}</span>
              </td>
            </tr>
            <tr class="flex flex-wrap">
              <td class="w-1/2 p-2 sm:p-3 text-center">
                <div class="text-xs font-bold text-gray-600 mb-1">تێلەفۆنی بەکارهێنەر</div>
                <span class="text-gray-800 break-words">{{ $note->phone_number ?? 'تێلەفۆن نیە' }}</span>
              </td>
              <td class="w-1/2 p-2 sm:p-3 text-center border-l">
                <div class="text-xs font-bold text-gray-600 mb-1">ناوی فرۆشیار</div>
                <span class="text-gray-800 break-words">{{ $note->seller_name ?? 'ناوی فرۆشیار نیە' }}</span>
              </td>
            </tr>
            </tbody>
          </table>
        </div>
        
        <div class="note-title text-base sm:text-lg md:text-xl font-semibold mt-4 mb-4 px-3 sm:px-0">{{ $note->title }}</div>
        
        <div class="note-input-wrapper px-3 sm:px-0">
          <div class="note-line-wrapper">
            <div id="line-numbers-show" class="note-line-numbers" aria-hidden="true"></div>
          </div>
          <div id="note-body-show-container" class="note-body-container"></div>
          <div class="note-numbers-wrapper">
            <small class="text-muted note-numbers-label">پارە بە دینار</small>
            <div id="note-numbers-show-container" class="note-numbers-column"></div>
          </div>
        </div>
        <div class="note-footer">
          <div class="note-footer-left"></div>
          <div class="note-footer-center">
            <strong class="show-total-label text-xs sm:text-sm">کۆی گشتی: <span id="show-total">0</span></strong>
          </div>
          <div class="note-footer-right"></div>
        </div>
        
        <!-- Hidden divs for data extraction -->
        <div class="note-body" style="display: none;">{{ $note->body }}</div>
        <div class="note-numbers" style="display: none;">{{ $note->numbers }}</div>
      </div>
    </div>

    <div class="summation-section mt-4 px-2 sm:px-3 md:px-6 text-xs sm:text-sm">
      <strong>کۆی گشتی:</strong> <span id="summation"></span>
    </div>

@endsection