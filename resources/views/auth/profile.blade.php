<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/app.css">
    <title>Profil</title>
    <style>
        body {
            background-color: #E8E0E5;
            color: #480E33;
            font-family: 'Instrument Sans', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            flex-direction: column;
            padding-top: 20px;
        }
        .profile-container {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 500px;
            width: 100%;
            margin-top: 20px;
        }
        .profile-container img {
            margin-top: 10px;
            border-radius: 50%;
            border: 2px solid #480E33;
        }
        .profile-container p {
            margin: 10px 0;
        }
        .profile-container form {
            margin-top: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .profile-container input, .profile-container button {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
        }
        .profile-container input {
            border: 1px solid #480E33;
        }
        .profile-container button {
            background-color: #480E33;
            color: #E8E0E5;
            border: none;
            cursor: pointer;
            transition: background 0.3s;
            display: none; /* Caché par défaut */
            text-align: center;
        }
        .profile-container button:hover {
            background-color: #8499A5;
        }
        .nav-links {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 15px;
        }
        .nav-links a {
            background-color: #480E33;
            color: #E8E0E5;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            transition: background 0.3s;
        }
        .nav-links a:hover {
            background-color: #8499A5;
        }
        /* Custom File Input */
        .file-upload {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 90%;
            margin: 10px 0;
            flex-direction: column;
        }
        .file-upload input[type="file"] {
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }
        .file-upload-label {
            display: block;
            background-color: #480E33;
            color: #E8E0E5;
            padding: 10px;
            text-align: center;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
            width: 100%;
        }
        .file-upload-label:hover {
            background-color: #8499A5;
        }
    </style>
    <script>
        function showUploadButton() {
            document.getElementById('uploadButton').style.display = 'block';
        }
    </script>
</head>
<body>
    <div class="profile-container">
        <div class="nav-links">
            <a href="{{ url('/dashboard') }}">Dashboard</a>
            <a href="{{ route('logout') }}">Se déconnecter</a>
        </div>
        <h1>Bienvenue {{ auth()->user()->username }}</h1>
        <p><strong>Email :</strong> {{ auth()->user()->email }}</p>
        <p><strong>Bio :</strong> {{ auth()->user()->bio ?? 'Aucune bio' }}</p>
        
        <form action="{{ route('profile.update-bio') }}" method="post">
            @csrf
            <input type="text" name="bio" value="{{ auth()->user()->bio ?? '' }}">
            <button type="submit">Mettre à jour</button>
        </form>

        @if(auth()->user()->profile_picture)
            <p><strong>Photo de profil :</strong></p>
            <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" alt="Profile Picture" width="150">
        @else
            <p>Aucune photo de profil</p>
        @endif
    </div>
    
    <div class="profile-container" style="margin-top: 20px;">
        <h2>Mettre à jour votre photo</h2>
        <form action="{{ url('/upload-image') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="file-upload">
                <input type="file" name="image" required onchange="showUploadButton()">
                <label class="file-upload-label">Choisir une image</label>
            </div>
            <button type="submit" id="uploadButton">Upload Image</button>
        </form>
    </div>
</body>
</html>
