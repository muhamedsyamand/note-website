// UI helper script for note rendering

function calculateSum() {
  const numbersContainer = document.getElementById('note-numbers-container');
  const numbersDisplay = document.querySelector('.note-numbers');
  const summationDisplay = document.getElementById('summation');
  const editTotal = document.getElementById('edit-total');
  const showTotal = document.getElementById('show-total');
  
  let sum = 0;
  
  if (numbersContainer) {
    const inputs = numbersContainer.querySelectorAll('input');
    inputs.forEach(input => {
      const value = parseFloat(input.value) || 0;
      sum += value;
    });
  } else if (numbersDisplay) {
    const numbersText = numbersDisplay.textContent;
    const numbers = numbersText.match(/(\d+(?:\.\d+)?)/g) || [];
    sum = numbers.reduce((acc, num) => acc + parseFloat(num), 0);
  }
  
  const formattedSum = sum % 1 === 0 ? Math.floor(sum) : sum.toFixed(2);
  
  if (summationDisplay) summationDisplay.textContent = formattedSum;
  if (editTotal) editTotal.textContent = formattedSum;
  if (showTotal) showTotal.textContent = formattedSum;
}

function generateLineNumberInputs() {
  const numbersContainer = document.getElementById('note-numbers-container');
  
  if (numbersContainer) {
    const minLines = 30;
    numbersContainer.innerHTML = '';
    const existingValues = (document.getElementById('numbers-hidden')?.value || '').split('\n');

    for (let i = 0; i < minLines; i++) {
      const input = document.createElement('input');
      input.type = 'text';
      input.className = 'number-input-line';
      input.style.cssText = 'width: 100%; height: 40px; border: none; border-bottom: 1px solid #d0d0d0; padding: 5px 5px; font-family: "Segoe UI", Arial, sans-serif; font-size: 1rem; text-align: right; background-color: #fff; background-image: repeating-linear-gradient(to bottom, transparent 0px, transparent 39px, #d0d0d0 39px, #d0d0d0 40px); background-size: 100% 40px; background-position: 0 0; background-attachment: local;';
      input.placeholder = '';
      input.inputMode = 'decimal';
      input.dataset.lineNumber = i + 1;

      if (existingValues[i]) input.value = existingValues[i];

      input.addEventListener('input', function(e) {
        e.target.value = e.target.value.replace(/[^0-9.]/g, '');
        const parts = e.target.value.split('.');
        if (parts.length > 2) e.target.value = parts[0] + '.' + parts[1];
        calculateSum();
      });

      numbersContainer.appendChild(input);
    }
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
    bodyContainer.innerHTML = '';
    const existingValues = (document.getElementById('body-hidden')?.value || '').split('\n');

    for (let i = 0; i < minLines; i++) {
      const input = document.createElement('input');
      input.type = 'text';
      input.className = 'body-input-line';
      input.style.cssText = 'width: 100%; height: 40px; border: none; border-bottom: 1px solid #d0d0d0; padding: 5px 10px; font-family: "Segoe UI", Arial, sans-serif; font-size: 1rem; background-color: #fff; background-image: repeating-linear-gradient(to bottom, transparent 0px, transparent 39px, #d0d0d0 39px, #d0d0d0 40px); background-size: 100% 40px; background-position: 0 0; background-attachment: local;';
      input.placeholder = '';
      input.dataset.lineNumber = i + 1;

      if (existingValues[i]) input.value = existingValues[i];
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
    bodyContainer.innerHTML = '';

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
    numbersContainer.innerHTML = '';

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

document.addEventListener('DOMContentLoaded', function() {
  calculateSum();
  generateLineNumbersEdit();
  generateLineBodyInputs();
  generateLineNumberInputs();
  generateLineNumbersShow();
  generateLineBodyInputsShow();
  generateLineNumberInputsShow();

  const form = document.getElementById('edit-note-form');
  if (form) form.addEventListener('submit', syncHiddenInputs);
});
