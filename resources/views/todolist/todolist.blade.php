<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>{{ $title }}</title>
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
            crossorigin="anonymous"
        />
    </head>
    <body>
        <div class="container col-xl-10 col-xxl-8 px-4 py-5">
            @if (isset($error))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $error }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="row">
                <form method="post" action="/logout">
                    @csrf
                    <button class="w-15 btn btn-lg btn-danger" type="submit">
                        Sign Out
                    </button>
                </form>
            </div>
            <div class="row align-items-center g-lg-5 py-5">
                <div class="col-lg-7 text-center text-lg-start">
                    <h1 class="display-4 fw-bold lh-1 mb-3">Todolist</h1>
                </div>
                <div class="col-md-10 mx-auto col-lg-5">
                    <form
                        class="p-4 p-md-5 border rounded-3 bg-light"
                        method="post"
                        action="/todolist"
                    >
                    @csrf
                        <div class="form-floating mb-3">
                            <input
                                type="text"
                                class="form-control"
                                name="todo"
                                placeholder="todo"
                            />
                            <label for="todo">Todo</label>
                        </div>
                        <button
                            class="w-100 btn btn-lg btn-primary"
                            type="submit"
                        >
                            Add Todo
                        </button>
                    </form>
                </div>
            </div>
            <div class="row align-items-right g-lg-5 py-5">
                <div class="mx-auto">
                    <form
                        id="deleteForm"
                        method="post"
                        style="display: none"
                    ></form>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Todo</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($todolist as $todo)
                                <tr>
                                    <th scope="row">{{ $todo['id'] }}</th>
                                    <td>{{ $todo['todo'] }}</td>
                                    <td>
                                        <form action="/todolist/{{ $todo['id'] }}/delete" method="post">
                                            @csrf
                                            <button
                                                class="w-100 btn btn-sm btn-danger"
                                                type="submit"
                                            >
                                                Remove
                                            </button>
                                        </form>
                                    </td>
                                </tr>  
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
