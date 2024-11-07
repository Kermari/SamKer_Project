<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SamKer's Note Application</title>
    <link rel="icon" href=".\sticky-notes.png">

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

</head>

<body>
    <h1> NOTES APPLICATION 共</h1>

    @if(session()->has('success'))
    <div class="alert-success">
        {{ session()->get('success') }}
    </div>
    @endif
    <div class="responsive">
        <div class="main">
            <table>
                <tr>
                    <th> ID </th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>View</th>
                    @foreach($notes as $note)
                <tr>
                    <td>{{ $note->id }}</td>
                    <td class="title-cell" data-full-title="{{ $note->title }}">
                        <span class="truncated-title">
                    </td>
                    <td class="description-cell" data-full-description="{{ $note->description }}">
                        <span class="truncated-description">
                    </td>

                    <td>
                        <div class="wrap">
                            <button class="view-button" onclick="showViewNoteDialog({{json_encode($note)}})"><i class="fa-solid fa-eye"></i> view note</button>
                    </td>


                    <dialog id="view-note">
                        <div class="dialog-content">
                            <div class="dialog-header">
                                <h2 id="note-title"></h2>

                            </div>
                            <div class="dialog-body">
                                <div class="note-section">
                                    <h3>Description</h3>
                                    <p id="note-description"></p>
                                </div>
                                <div class="note-section">
                                    <h3>Content</h3>
                                    <p id="note-content"></p>
                                    <div class="note-section">
                                        <h3>Dates</h3>
                                        <p>Created: <span id="note-created-at"></p>
                                        <p>Updated: <span id="note-updated-at"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="dialog-footer">
                                <button class="list-item1" onclick="closeViewDialog()"><i class="fa-solid fa-arrow-left"></i></button>
                                <button class="list-item2" id="edit-button"><i class="fa-solid fa-pen"></i></button>
                                <button class="list-item3" id="delete-button"><i class="fa-solid fa-trash"></i></button>
                            </div>
                        </div>
                    </dialog>
        </div>

        <dialog id="delete-note">

            <h2>Confirm Delete</h2>

            <p>Are you sure you want to delete this note?</p>

            <form id="delete-note-form" method="post" action=""> @csrf @method('delete')

                <button class="delete-yes" id="delete-note-form" type="submit">Yes, delete</button>

                <button class="delete" id="delete-note-form" type="button" onclick="closeDeleteDialog()">Cancel</button>

            </form>
        </dialog>

        </tr>
        </tr>
        @endforeach
        <div>
            <button class="floating-button" onclick="NewNote()">Add new note<i class="fa-solid fa-plus"></i></button>
        </div>
        </table>
    </div>

    <script>
        const dialog = document.getElementById("view-note");
        const noteTitle = document.getElementById("note-title");
        const noteContent = document.getElementById("note-content");
        const descriptionElement = document.getElementById('note-description');
        const editButton = document.getElementById("edit-button");
        const deleteButton = document.getElementById("delete-button");
        const deleteDialog = document.getElementById("delete-note");
        const deleteNoteForm = document.getElementById("delete-note-form")
        const viewNoteCreateAt = document.getElementById("note-created-at")
        const viewNoteUpdateAt = document.getElementById("note-updated-at")

        function showViewNoteDialog(note) {
            noteTitle.textContent = note.title;
            descriptionElement.textContent = note.description;
            noteContent.textContent = note.content;
            viewNoteCreateAt.textContent  = formatDate(note.created_at);
            viewNoteUpdateAt.textContent =  formatDate(note.updated_at);


            editButton.onclick = function() {
                dialog.close()
                window.location.href = `/note/${note.id}/edit`;
            };


            deleteButton.onclick = function() {
                showDeleteNoteDialog(note.id);
            };

            dialog.showModal();
        }

        function closeViewDialog() {
            dialog.close();
        }

        function formatDate(dateString) {
            const date = new Date(dateString);
            const months = [
                'January', 'February', 'March', 'April', 'May', 'June',
                'July', 'August', 'September', 'October', 'November', 'December'
            ];

            const year = date.getFullYear();
            const month = months[date.getMonth()];
            const day = date.getDate();
            const hour = date.getHours().toString().padStart(2, '0');
            const minute = date.getMinutes().toString().padStart(2, '0');
            const ampm = hour >= 12 ? 'PM' : 'AM';

            return `${month} ${day}, ${year} at ${hour}:${minute} ${ampm}`;
        }

        function showDeleteNoteDialog(id) {
            deleteNoteForm.action = `/note/${id}`;
            deleteDialog.showModal();
        }

        function closeDeleteDialog() {
            deleteDialog.close();
        }

        function NewNote() {
            window.location.href = `/create`;
        }

        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();

                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            var alert = document.querySelector('.alert-success');
            if (alert) {
                setTimeout(function() {
                    alert.style.opacity = '1';
                    (function fade() {
                        if ((alert.style.opacity -= .1) < 0) {
                            alert.style.display = 'none';
                        } else {
                            requestAnimationFrame(fade);
                        }
                    })();
                }, 2500);
            }
        })

        document.addEventListener('DOMContentLoaded', function() {
            const descriptionCells = document.querySelectorAll('.description-cell');
            const maxLength = 65;

            descriptionCells.forEach(cell => {
                const fullDescription = cell.dataset.fullDescription;
                const truncatedSpan = cell.querySelector('.truncated-description');

                if (fullDescription.length > maxLength) {
                    let truncated = fullDescription.substr(0, maxLength);
                    let lastSpaceIndex = truncated.lastIndexOf(' ');
                    if (lastSpaceIndex > 0) {
                        truncated = truncated.substr(0, lastSpaceIndex);
                    }
                    truncatedSpan.textContent = truncated + '...';
                } else {
                    truncatedSpan.textContent = fullDescription;
                }

                cell.title = fullDescription;
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            const titleCells = document.querySelectorAll('.title-cell');
            const descriptionCells = document.querySelectorAll('.description-cell');
            const maxLength = 65;

            function truncateText(cell, maxLength) {
                const fullText = cell.dataset.fullTitle || cell.dataset.fullDescription;
                const truncatedSpan = cell.querySelector('.truncated-title') || cell.querySelector('.truncated-description');

                if (fullText.length > maxLength) {
                    let truncated = fullText.substr(0, maxLength);
                    let lastSpaceIndex = truncated.lastIndexOf(' ');
                    if (lastSpaceIndex > 0) {
                        truncated = truncated.substr(0, lastSpaceIndex);
                    }
                    truncatedSpan.textContent = truncated + '...';
                } else {
                    truncatedSpan.textContent = fullText;
                }

                cell.title = fullText;
            }

            titleCells.forEach(cell => truncateText(cell, maxLength));
            descriptionCells.forEach(cell => truncateText(cell, maxLength));
        });

        document.addEventListener('DOMContentLoaded', function() {
            const titleCells = document.querySelectorAll('.title-cell');
            const descriptionCells = document.querySelectorAll('.description-cell');
            const maxLength = 30;

            function truncateText(cell, maxLength) {
                const fullText = cell.dataset.fullTitle || cell.dataset.fullDescription;
                const truncatedSpan = cell.querySelector('.truncated-title') || cell.querySelector('.truncated-description');

                if (fullText.length > maxLength) {
                    let truncated = fullText.substr(0, maxLength);
                    let lastSpaceIndex = truncated.lastIndexOf(' ');
                    if (lastSpaceIndex > 0) {
                        truncated = truncated.substr(0, lastSpaceIndex);
                    }
                    truncatedSpan.textContent = truncated + '...';
                } else {
                    truncatedSpan.textContent = fullText;
                }

                cell.title = fullText;
            }

            titleCells.forEach(cell => truncateText(cell, maxLength));
            descriptionCells.forEach(cell => truncateText(cell, maxLength));
        });
    </script>

</body>

</html>