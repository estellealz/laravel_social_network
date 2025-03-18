<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/app.css">
    <title>Register</title>
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
        .register-form {
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
        .register-form input, .register-form textarea {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #480E33;
            border-radius: 5px;
        }
        .register-form button {
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
        .register-form button:hover {
            background-color: #8499A5;
        }
    </style>
</head>
<body>
    <form method="POST" action="{{ route('api.register') }}" class="register-form">
        @csrf
        <h2>Inscription</h2>
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <textarea name="bio" placeholder="Bio" rows="3"></textarea>
        <button type="submit">Register</button>
    </form>
</body>
</html>
