<div class="modal video-modal fade" id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                Sign In & Sign Up
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <section>
                <div class="modal-body">
                    <div class="w3_login_module">
                        <div class="module form-module">

                            <div class="toggle">
                                <i class="fa fa-times fa-pencil"></i>
                                <div class="tooltip">Click Me</div>
                            </div>

                            <!-- LOGIN -->
                            <div class="form">
                                <h3>Login to your account</h3>

                                <form action="{{ route('login.process') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="auth_form" value="login">

                                    <input type="email" name="email"
                                        placeholder="Email Address"
                                        value="{{ old('email') }}" required>

                                    <input type="password" name="password"
                                        placeholder="Password" required>

                                    <input type="submit" value="Login">
                                </form>

                                @if (old('auth_form') === 'login' && $errors->any())
                                    <div class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                            <p>{{ $error }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            <!-- REGISTER -->
                            <div class="form">
                                <h3>Create an account</h3>

                                <form action="{{ route('register.process') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="auth_form" value="register">

                                    <input type="text" name="name"
                                        placeholder="Full Name" required>

                                    <input type="email" name="email"
                                        placeholder="Email Address" required>

                                    <input type="password" name="password"
                                        placeholder="Password" required>

                                    <input type="password" name="password_confirmation"
                                        placeholder="Confirm Password" required>

                                    <input type="submit" value="Register">
                                </form>

                                @if (old('auth_form') === 'register' && $errors->any())
                                    <div class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                            <p>{{ $error }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            <div class="cta">
                                <a href="#">Forgot your password?</a>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<script>
    $(function () {
        $('.toggle').click(function () {
            $(this).children('i').toggleClass('fa-pencil');

            $('.form').animate({
                height: "toggle",
                'padding-top': 'toggle',
                'padding-bottom': 'toggle',
                opacity: "toggle"
            }, "slow");
        });

        var authForm = @json(old('auth_form', session('auth_modal')));
        if (authForm) {
            var forms = $('.form-module .form');
            forms.eq(0).toggle(authForm !== 'register');
            forms.eq(1).toggle(authForm === 'register');
            $('#myModal').modal('show');
        }
    });
</script>
