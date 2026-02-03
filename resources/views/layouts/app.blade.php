<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Notes App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-3 mb-md-4">
  <div class="container-fluid px-2 px-md-3 px-lg-0">
    <div class="container">
      <a class="navbar-brand" href="{{ url('/') }}">Notes</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="mainNavbar">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="{{ route('notes.index') }}">All Notes</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('notes.create') }}">New Note</a></li>
        </ul>
      </div>
    </div>
  </div>
</nav>

<div class="container-fluid px-2 px-md-3 px-lg-0">
  <div class="container">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
    @endif

    @yield('content')
  </div>
</div>

<script>
  function calculateSum() {
    const numbersContainer = document.getElementById('note-numbers-container');
    const numbersDisplay = document.querySelector('.note-numbers');
    const summationDisplay = document.getElementById('summation');
    const editSummation = document.getElementById('edit-summation');
    const showSummation = document.getElementById('show-summation');
    const editTotal = document.getElementById('edit-total');
    const showTotal = document.getElementById('show-total');
    
    let sum = 0;
    
    // Calculate from individual inputs
    if (numbersContainer) {
      const inputs = numbersContainer.querySelectorAll('input');
      inputs.forEach(input => {
        const value = parseFloat(input.value) || 0;
        sum += value;
      });
    } else if (numbersDisplay) {
      // Fallback for show view
      const numbersText = numbersDisplay.textContent;
      const numbers = numbersText.match(/(\d+(?:\.\d+)?)/g) || [];
      sum = numbers.reduce((acc, num) => acc + parseFloat(num), 0);
    }
    
    // Format the sum to show full number up to 10000000
    const formattedSum = sum % 1 === 0 ? Math.floor(sum) : sum.toFixed(2);
    
    if (summationDisplay) {
      summationDisplay.textContent = formattedSum;
    }
    if (editSummation) {
      editSummation.textContent = formattedSum;
    }
    if (showSummation) {
      showSummation.textContent = formattedSum;
    }
    if (editTotal) {
      editTotal.textContent = formattedSum;
    }
    if (showTotal) {
      showTotal.textContent = formattedSum;
    }
  }

  // Update total continuously
  setInterval(calculateSum, 100);

  function generateLineNumberInputs() {
    const numbersContainer = document.getElementById('note-numbers-container');
    
    if (numbersContainer) {
      const minLines = 30;
      
      // Clear existing inputs
      numbersContainer.innerHTML = '';
      
      // Create input for each line
      for (let i = 0; i < minLines; i++) {
        const input = document.createElement('input');
        input.type = 'text';
        input.className = 'number-input-line';
        input.style.cssText = 'width: 100%; height: 40px; border: none; border-bottom: 1px solid #d0d0d0; padding: 5px 5px; font-family: "Segoe UI", Arial, sans-serif; font-size: 1rem; text-align: right; background-color: #fff; background-image: repeating-linear-gradient(to bottom, transparent 0px, transparent 39px, #d0d0d0 39px, #d0d0d0 40px); background-size: 100% 40px; background-position: 0 0; background-attachment: local;';
        input.placeholder = '';
        input.inputMode = 'decimal';
        input.dataset.lineNumber = i + 1;
        
        // Add existing value if available
        const existingValues = (document.getElementById('numbers-hidden')?.value || '').split('\n');
        if (existingValues[i]) {
          input.value = existingValues[i];
        }
        
        // Only allow numbers and decimal point
        input.addEventListener('input', function(e) {
          e.target.value = e.target.value.replace(/[^0-9.]/g, '');
          // Prevent multiple decimal points
          const parts = e.target.value.split('.');
          if (parts.length > 2) {
            e.target.value = parts[0] + '.' + parts[1];
          }
          calculateSum();
        });
        
        numbersContainer.appendChild(input);
      }
    }
  }

  function generateLineNumbers() {
    const bodyElement = document.querySelector('.note-body');
    const lineNumbersElement = document.getElementById('line-numbers');
    
    if (bodyElement && lineNumbersElement) {
      const bodyText = bodyElement.textContent;
      const lines = bodyText.split('\n');
      
      let lineNumbersText = '';
      for (let i = 1; i <= lines.length; i++) {
        lineNumbersText += i + '\n';
      }
      
      lineNumbersElement.textContent = lineNumbersText;
    }
  }

  function generateLineNumbersEdit() {
    const bodyContainer = document.getElementById('note-body-container');
    const lineNumbersEditElement = document.getElementById('line-numbers-edit');
    
    if (bodyContainer && lineNumbersEditElement) {
      const minLines = 30;
      
      let lineNumbersText = '';
      for (let i = 1; i <= minLines; i++) {
        lineNumbersText += (i < 10 ? ' ' : '') + i + '\n';
      }
      
      lineNumbersEditElement.textContent = lineNumbersText;
    }
  }

  function generateLineBodyInputs() {
    const bodyContainer = document.getElementById('note-body-container');
    
    if (bodyContainer) {
      const minLines = 30;
      
      // Clear existing inputs
      bodyContainer.innerHTML = '';
      
      // Create input for each line
      for (let i = 0; i < minLines; i++) {
        const input = document.createElement('input');
        input.type = 'text';
        input.className = 'body-input-line';
        input.style.cssText = 'width: 100%; height: 40px; border: none; border-bottom: 1px solid #d0d0d0; padding: 5px 10px; font-family: "Segoe UI", Arial, sans-serif; font-size: 1rem; background-color: #fff; background-image: repeating-linear-gradient(to bottom, transparent 0px, transparent 39px, #d0d0d0 39px, #d0d0d0 40px); background-size: 100% 40px; background-position: 0 0; background-attachment: local;';
        input.placeholder = '';
        input.dataset.lineNumber = i + 1;
        
        // Add existing value if available
        const existingValues = (document.getElementById('body-hidden')?.value || '').split('\n');
        if (existingValues[i]) {
          input.value = existingValues[i];
        }
        
        bodyContainer.appendChild(input);
      }
    }
  }

  function generateLineBodyInputsShow() {
    const bodyContainer = document.getElementById('note-body-show-container');
    
    if (bodyContainer) {
      const minLines = 30;
      const bodyText = document.querySelector('.note-body');
      const bodyData = bodyText ? bodyText.textContent : '';
      const bodyLines = bodyData.split('\n');
      
      // Clear existing inputs
      bodyContainer.innerHTML = '';
      
      // Create input for each line
      for (let i = 0; i < minLines; i++) {
        const input = document.createElement('input');
        input.type = 'text';
        input.className = 'body-input-line';
        input.readOnly = true;
        input.style.cssText = 'width: 100%; height: 40px; border: none; border-bottom: 1px solid #d0d0d0; padding: 5px 10px; font-family: "Segoe UI", Arial, sans-serif; font-size: 1rem; background-color: #fff; background-image: repeating-linear-gradient(to bottom, transparent 0px, transparent 39px, #d0d0d0 39px, #d0d0d0 40px); background-size: 100% 40px; background-position: 0 0; background-attachment: local;';
        input.placeholder = '';
        input.dataset.lineNumber = i + 1;
        input.value = bodyLines[i] || '';
        
        bodyContainer.appendChild(input);
      }
    }
  }

  function generateLineNumberInputsShow() {
    const numbersContainer = document.getElementById('note-numbers-show-container');
    
    if (numbersContainer) {
      const minLines = 30;
      const numbersText = document.querySelector('.note-numbers');
      const numbersData = numbersText ? numbersText.textContent : '';
      const numbersLines = numbersData.split('\n');
      
      // Clear existing inputs
      numbersContainer.innerHTML = '';
      
      // Create input for each line
      for (let i = 0; i < minLines; i++) {
        const input = document.createElement('input');
        input.type = 'text';
        input.className = 'number-input-line';
        input.readOnly = true;
        input.style.cssText = 'width: 100%; height: 40px; border: none; border-bottom: 1px solid #d0d0d0; padding: 5px 5px; font-family: "Segoe UI", Arial, sans-serif; font-size: 1rem; text-align: right; background-color: #fff; background-image: repeating-linear-gradient(to bottom, transparent 0px, transparent 39px, #d0d0d0 39px, #d0d0d0 40px); background-size: 100% 40px; background-position: 0 0; background-attachment: local;';
        input.placeholder = '';
        input.dataset.lineNumber = i + 1;
        input.value = numbersLines[i] || '';
        
        numbersContainer.appendChild(input);
      }
    }
  }

  function generateLineNumbersShow() {
    const lineNumbersElement = document.getElementById('line-numbers-show');
    
    if (lineNumbersElement) {
      const minLines = 30;
      
      let lineNumbersText = '';
      for (let i = 1; i <= minLines; i++) {
        lineNumbersText += (i < 10 ? ' ' : '') + i + '\n';
      }
      
      lineNumbersElement.textContent = lineNumbersText;
    }
  }

  function limitLinesToThirty(element) {
    if (!element) return;
    
    const lines = element.textContent.split('\n');
    
    if (lines.length > 30) {
      // Keep only the first 30 lines
      element.textContent = lines.slice(0, 30).join('\n');
      // Move cursor to the end
      const range = document.createRange();
      const sel = window.getSelection();
      range.selectNodeContents(element);
      range.collapse(false);
      sel.removeAllRanges();
      sel.addRange(range);
    }
  }

  function preventInputAfterLine30(element) {
    if (!element) return;
    
    const lines = element.textContent.split('\n');
    return lines.length < 30;
  }

  function syncHiddenInputs() {
    const bodyContainer = document.getElementById('note-body-container');
    const numbersContainer = document.getElementById('note-numbers-container');
    const bodyHidden = document.getElementById('body-hidden');
    const numbersHidden = document.getElementById('numbers-hidden');
    
    if (bodyContainer && bodyHidden) {
      const inputs = bodyContainer.querySelectorAll('input');
      const bodyArray = Array.from(inputs).map(input => input.value || '');
      bodyHidden.value = bodyArray.join('\n');
    }
    
    if (numbersContainer && numbersHidden) {
      const inputs = numbersContainer.querySelectorAll('input');
      const numbersArray = Array.from(inputs).map(input => input.value || '');
      numbersHidden.value = numbersArray.join('\n');
    }
  }
  
  // Calculate on load
  document.addEventListener('DOMContentLoaded', function() {
    calculateSum();
    generateLineNumbers();
    generateLineNumbersEdit();
    generateLineBodyInputs();
    generateLineNumberInputs();
    generateLineNumbersShow();
    generateLineBodyInputsShow();
    generateLineNumberInputsShow();
    
    // Sync hidden inputs before form submission
    const form = document.getElementById('edit-note-form');
    if (form) {
      form.addEventListener('submit', syncHiddenInputs);
    }

      // Sync vertical scrolling between columns (edit and show)
      function setupScrollSync(ids) {
        const elems = ids.map(id => document.getElementById(id)).filter(Boolean);
        if (elems.length < 2) return;
        let isSyncing = false;

        elems.forEach(src => {
          src.addEventListener('scroll', function() {
            if (isSyncing) return;
            isSyncing = true;
            const top = src.scrollTop;
            elems.forEach(el => { if (el !== src) el.scrollTop = top; });
            // small timeout to avoid recursion
            setTimeout(() => { isSyncing = false; }, 10);
          });
        });
      }

      // Setup for edit view
      setupScrollSync(['line-numbers-edit', 'note-body-container', 'note-numbers-container']);
      // Setup for show view
      setupScrollSync(['line-numbers-show', 'note-body-show-container', 'note-numbers-show-container']);
  });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>