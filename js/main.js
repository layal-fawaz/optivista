function toggleEyeDetails(id) {
    let right = document.getElementById('details-' + id);
    let left = document.getElementById('details-' + id + '-l');

    if (right.style.display === 'none' || right.style.display === '') {
        right.style.display = 'table-row';
        left.style.display = 'table-row';
    } else {
        right.style.display = 'none';
        left.style.display = 'none';
    }
}
