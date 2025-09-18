<!DOCTYPE html>
<html lang="en">

@include('layouts.head')

<body class="login-bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-4 col-lg-5 col-sm-6 col-12">
                <form action="{{ route('auth.login') }}" method="post" class="my-5">
                    @csrf
                    <div class="login-form rounded-4 p-4 mt-5">
                        <div class="d-flex justify-content-center mb-4">
                            <a href="#">
                                <img src="{{ asset('assets/images/logo.jpg') }}" class="img-fluid login-logo"
                                    alt="Unity Admin Dashboard">
                            </a>
                        </div>
                        <h2 class="fw-light mb-4">Login</h2>

                        {{-- Affichage des erreurs de validation --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="mb-3">
                            <label class="form-label" for="yEmail">UserName</label>
                            {{-- CORRECTION : Le nom du champ doit être "username" --}}
                            <input type="text" id="yEmail" name="username" class="form-control border-0"
                                placeholder="Username">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="pwd">Password</label>
                            <input type="password" id="pwd" name="password" class="form-control border-0"
                                placeholder="password">
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="form-check m-0">
                                <input class="form-check-input border-0" type="checkbox" value=""
                                    id="rememberPassword">
                                <label class="form-check-label" for="rememberPassword">Remember</label>
                            </div>
                            <a href="forgot-password.html" class="text-white text-decoration-underline">Lost
                                password?</a>
                        </div>
                        <div class="d-grid py-3 mt-3">
                            <button type="submit" class="btn btn-lg btn-primary">
                                Login
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
