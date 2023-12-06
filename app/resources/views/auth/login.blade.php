<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <div class="main">
        <input type="checkbox" id="chk" aria-hidden="true">

        <div class="signup">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <label for="chk" aria-hidden="true">Sign up</label>
                <input id="name" type="text" name="name" placeholder="Username" value="{{ old('name') }}" autocomplete="name" autofocus required>
                <input id="email" type="email" name="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email">
                <input id="password" type="password" name="password" placeholder="Password" name="password" required autocomplete="new-password">
                <input id="password-confirm" type="password" name="password_confirmation" placeholder="Confirm Password" required>
                <button type="submit">Sign up</button>
            </form>
        </div>

        <div class="login">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <label for="chk" aria-hidden="true">Login</label>
                <input id="email" type="email" name="email" placeholder="Email" required>
                <input id="password" type="password" name="password" placeholder="Password" required>
                <button type="submit">Login</button>
            </form>
        </div>
    </div>
</body>

</html>
