function showForm(categoryID) {
    document.getElementById('form-' + categoryID).style.display = 'inline-block';
    document.getElementById('addBtn-' + categoryID).style.display = 'none';
}

function hideForm(categoryID) {
    document.getElementById('form-' + categoryID).style.display = 'none';
    document.getElementById('addBtn-' + categoryID).style.display = 'inline-block';
}

function showCategoryForm() {
    document.getElementById('categoryForm').style.display = 'flex';
    document.getElementById('addCategoryBtn').style.display = 'none';
}

function hideCategoryForm() {
    document.getElementById('categoryForm').style.display = 'none';
    document.getElementById('addCategoryBtn').style.display = 'flex';
}