<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Note</title>

    <link rel="icon" href="\sticky-notes.png">

    <link rel="stylesheet" href="{{ asset('css/edit.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    
</head>

<body>
    <div class="container">
        <h1>Editing your note</h1>

        @if($errors->any())
            <div class="error-list">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="post" action="{{route('note.update', ['note' => $note]) }}">
            @csrf
            @method('put')

            <div>
                <label for="title">Title</label>
                <textarea id="title" name="title" maxlength="255">{{old('title', $note->title)}}</textarea>
            </div>

            <div>
                <label for="description">Description</label>
                <textarea id="description" name="description" maxlength="255" placeholder="Brief excerpt...">{{old('description', $note->description)}}</textarea>
            </div>

            <div>
                <label for="content">Content</label>
                <textarea id="content" name="content" maxlength="10000" placeholder="Write something here...">{{old('content', $note->content)}}</textarea>
            </div>

            <div>
                <button id="Back" type="button" onclick="goBack()">
                <i class="fa-solid fa-arrow-left-long"></i>
                </button>
                <button id="update" type="submit">
                    <i class="fa-regular fa-circle-check"></i> Update note
                </button>
            </div>
        </form>
    </div>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>

</html>
