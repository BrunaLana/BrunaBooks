function confirmDeletion(event, message) {
    event.preventDefault();
    const confirmDialog = document.getElementById('confirm-dialog');
    document.querySelector('#confirm-dialog p').innerHTML = message;
    confirmDialog.style.display = 'block';

    const confirmButton = document.getElementById('confirm-button');
    const cancelButton = document.getElementById('cancel-button');

    confirmButton.onclick = function() {
        window.location.href = event.target.closest('a').href;
    };

    cancelButton.onclick = function() {
        confirmDialog.style.display = 'none';
    };
}