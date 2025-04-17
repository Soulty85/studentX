const deleteButtons = document.querySelectorAll('.btn-deleteNote');
const hiddenInput = document.getElementById('idNoteDel');

deleteButtons.forEach(button => {
    button.addEventListener('click', function () {
        const noteId = this.getAttribute('data-id');
        hiddenInput.value = noteId;
    });
});

const editButtons = document.querySelectorAll('.btn-edit-note');
const inputNoteId = document.getElementById('editNoteId');

editButtons.forEach(button => {
button.addEventListener('click', () => {
    const noteId = button.getAttribute('data-id');

    inputNoteId.value = noteId;
    });
});