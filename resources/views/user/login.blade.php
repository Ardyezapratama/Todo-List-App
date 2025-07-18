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
        <div class="container py-5 h-100">
            <div
                class="row d-flex justify-content-center align-items-center h-100"
            >
                @if (isset($error))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ $error }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card">
                        <div class="card-body py-3 text-center d-flex justify-content-center">
                            <div class="mb-md-5 mt-md-4 pb-3">
                                <h2 class="fw-bold mb-2 text-uppercase">
                                    Login
                                </h2>
                                <p class="mb-5">
                                    Enter your user id and password!
                                </p>
                                <form action="/login" method="post">
                                    @csrf
                                    <div class="form-floating mb-3">
                                        <input
                                            type="text"
                                            name="user"
                                            class="form-control"
                                            id="user"
                                            placeholder="id"
                                        />
                                        <label for="user">User</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input
                                            type="password"
                                            name="password"
                                            class="form-control"
                                            id="password"
                                            placeholder="password"
                                        />
                                        <label for="password">Password</label>
                                    </div>
                                    <button
                                        class="btn btn-primary btn-lg px-5 mb-3"
                                        type="submit"
                                    >
                                        Login
                                    </button>
                                    <!-- <div>
                                        <p class="mb-0">
                                            Don't have an account?
                                            <a href="/register" class="fw-bold"
                                                >Sign Up</a
                                            >
                                        </p>
                                    </div> -->
                                </form>
                            </div>
                        </div>
                    </div>
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
