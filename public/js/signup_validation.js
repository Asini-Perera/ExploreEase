document.querySelectorAll('input[required]').forEach(input => {
    input.addEventListener('blur', () => {
        if (!input.value.trim()) {
            input.style.border = '2px solid #d8000c';
            input.style.backgroundColor = '#ffcccc';
            input.placeholder = 'This field is required';
        } else {
            input.style.border = '2px solid #006600';
            input.style.backgroundColor = '#ccffcc';
        }
        input.style.transition = 'border 0.3s, background-color 0.3s';
    });
});
