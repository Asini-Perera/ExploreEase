function showForm(categoryID) {
    document.getElementById('form-' + categoryID).style.display = 'inline-block';
    document.getElementById('addBtn-' + categoryID).style.display = 'none';
}

function hideForm(categoryID) {
    document.getElementById('form-' + categoryID).style.display = 'none';
    document.getElementById('addBtn-' + categoryID).style.display = 'inline-block';
}