<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/app.css">
    <title>Login</title>
    <style>
        body {
            background-color: #E8E0E5;
            color: #480E33;
            font-family: 'Instrument Sans', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-form {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .login-form input {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #480E33;
            border-radius: 5px;
        }
        .login-form button {
            background-color: #480E33;
            color: #E8E0E5;
            border: none;
            padding: 10px;
            width: 95%;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
            margin-top: 15px;
        }
        .login-form button:hover {
            background-color: #8499A5;
        }
    </style>
</head>
<body>
    <form method="POST" action="{{ route('api.login') }}" class="login-form">
        @csrf
        <h2>Connexion</h2>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>

    <script>
        axios.post('/api/users/login', {
            email: this.email,
            password: this.password
        })
        .then(response => {
            localStorage.setItem('token', response.data.token);
            localStorage.setItem('user', JSON.stringify(response.data.user));
            window.location.href = '/profile';
        })
        .catch(error => {
            console.error('Login failed', error);
        });
    </script>
</body>
</html>