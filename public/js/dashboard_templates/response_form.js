function showResponseForm(reviewID) {
    document.getElementById('response-form-' + reviewID).style.display = 'block';
}

function cancelResponse(reviewID) {
    document.getElementById('response-form-' + reviewID).style.display = 'none';
}