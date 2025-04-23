document.querySelectorAll('input[required], textarea[required]').forEach(element => {
    element.addEventListener('blur', () => {
        if (!element.value.trim()) {
            element.style.border = '2px solid #d8000c';
            element.style.backgroundColor = '#ffcccc';
            element.placeholder = 'This field is required';
        } else {
            element.style.border = '2px solid #006600';
            element.style.backgroundColor = '#ccffcc';
        }
        element.style.transition = 'border 0.3s, background-color 0.3s';
    });
});
