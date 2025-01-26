<div id="confirm-dialog" class="confirm-dialog">
    <p id="confirm-message"></p>
    <hr/>
    <div class="confirm-buttons">
        <button id="confirm-button" class="btn botao-delete">Sim</button>
        <button id="cancel-button" class="btn botao-confirm">Não</button>
    </div>
</div>
<script>
    function confirmDeletion(event, message) {
        event.preventDefault();
        const confirmDialog = document.getElementById('confirm-dialog');
        const confirmMessage = document.getElementById('confirm-message');
        confirmMessage.textContent = message;
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
</script>