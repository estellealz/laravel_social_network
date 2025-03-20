<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            background-color: #E8E0E5;
            color: #480E33;
            font-family: 'Instrument Sans', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }
        .dashboard-container {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 500px;
            width: 100%;
        }
        .dashboard-title {
            margin-bottom: 20px;
        }
        .profile-button {
            background-color: #480E33;
            color: #E8E0E5;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
            margin-top: 15px;
            text-decoration: none;
            display: inline-block;
        }
        .profile-button:hover {
            background-color: #8499A5;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h1 class="dashboard-title">Tableau de Bord</h1>
        <p>Bienvenue, {{ auth()->user()->username }} !</p>
        
        <a href="{{ route('profile') }}" class="profile-button">Voir mon Profil</a>
    </div>
</body>
</html>