
const dialog = document.getElementById("view-note");
const noteTitle = document.getElementById("note-title");
const noteContent = document.getElementById("note-content");
const editButton = document.getElementById("edit-button");
const deleteButton = document.getElementById("delete-button");
const deleteDialog = document.getElementById("delete-note");
const deleteNoteForm = document.getElementById("delete-note-form")
const wrapper = document.querySelector(".wrapper")

function showViewNoteDialog(note) {
    noteTitle.textContent = note.title;
    noteContent.textContent = note.content;
    editButton.onclick = function() {
        window.location.href = `/note/${note.id}/edit`;
    };

    deleteButton.onclick = function() {
        showDeleteNoteDialog(note.id);
    };

    dialog.showModal();
}

function closeViewDialog() {
    dialog.close()
}

function showDeleteNoteDialog(id) {
    deleteNoteForm.action = `/note/${id}`;
    deleteDialog.showModal();
}

function closeDeleteDialog() {
    deleteDialog.close();
}