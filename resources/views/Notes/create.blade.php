<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a note</title>

    <link rel="icon" href=".\sticky-notes.png">

    <link rel="stylesheet" href="{{ asset('css/create.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
</head>

<body>

    <div class="container">
        <h1> Create a note :D </h1>

        @if($errors->any())
        <div class="error-list">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{$error}}</li>

                @endforeach
            </ul>
</div>
            @endif


            <form method="post" action="{{route('note.store')}}">
                @csrf
                @method('post')

                <div id="margin">

                    <div class="form-field">
                        <label for="title">Title</label>
                        <textarea id="title" name="title" maxlength="255">{{old('title')}}</textarea>
                        <div class="word-count" id="titleCount"></div>
                    </div>

                    <div class="form-field">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" maxlength="255" placeholder="Brief excerpt...">{{old('description')}}</textarea>
                        <div class="word-count" id="descriptionCount"></div>
                    </div>

                    <div class="form-field">
                        <label for="content">Content</label>
                        <textarea id="content" name="content" placeholder="Write something here..." maxlength="10000">{{old('content')}}</textarea>
                        <div class="word-count" id="contentCount"></div>
                    </div>

                </div>
                <div>
                    <button id="update" type="submit"><i class="fa-regular fa-circle-check"></i> Save note</button>
                </div>

            </form>

            <div>
                <a href="{{ route('note.index') }}" class="btn-link">
                    <button type="button" id="Back">
                        <i class="fa-solid fa-arrow-left"></i>
                    </button>
                </a>
            </div>


        </div>

</body>
<script>
    console.log('Script started');

    function countWords(str) {
        return str.trim().split(/\s+/).filter(Boolean).length;
    }

    function updateWordCount(textareaId, counterId) {
        console.log(`Updating word count for ${textareaId}`);
        const textarea = document.getElementById(textareaId);
        const counter = document.getElementById(counterId);

        if (!textarea || !counter) {
            console.error(`Textarea or counter not found for ${textareaId}`);
            return;
        }

        function updateCount() {
            const wordCount = countWords(textarea.value);
            const charCount = textarea.value.length;
            counter.textContent = `Words: ${wordCount} | Characters: ${charCount}`;
            console.log(`Updated count for ${textareaId}: ${counter.textContent}`);
        }

        textarea.addEventListener('input', updateCount);
        updateCount(); // Initial count
    }

    // Wait for the DOM to be fully loaded
    document.addEventListener('DOMContentLoaded', function() {
        console.log('DOM fully loaded');
        updateWordCount('title', 'titleCount');
        updateWordCount('description', 'descriptionCount');
        updateWordCount('content', 'contentCount');
    });
</script>

</html>