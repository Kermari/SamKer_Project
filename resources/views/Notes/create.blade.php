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
        <div>
            @if($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{$error}}</li>

                @endforeach
            </ul>
            @endif
        </div>

        <form method="post" action="{{route('note.store')}}">
            @csrf
            @method('post')

            <div id="margin">

                <div class="form-field">
                    <label>Title</label>
                    <textarea id="text1" name="title">{{old('title')}}</textarea>
                </div>

                <div class="form-field">
                    <label>Description</label>
                    <textarea id="text1" name="description" placeholder="Brief excerpt...">{{old('description')}}</textarea>
                </div>

                <div class="form-field">
                    <label>Content</label>
                    <textarea id="text" name="content" maxlength="10000" placeholder="Write something here...">{{old('content')}}</textarea>
                </div>

            </div>
            <div>
                <button id="update" type="submit"><i class="fa-regular fa-circle-check"></i> Save note</button>
            </div>

        </form>
            <div>
                <button id="Back" onclick="goBack()"><box-icon name='left-arrow-alt'>Back</box-icon></button>
            </div>


        </div>

        <script>
            function goBack() {
                window.history.back();
            }
        </script>

        </script>
    </div>
</body>

</html>