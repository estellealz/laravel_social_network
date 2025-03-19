<div class="container">
    <h1>Bienvenue {{ auth()->user()->username }}</h1>

    <p><strong>Email :</strong> {{ auth()->user()->email }}</p>
    <p><strong>Bio :</strong> {{ auth()->user()->bio ?? 'Aucune bio' }}</p>
    <!--modifier la Bio-->
    <form action="{{ route('profile.update-bio') }}" method="post">
        @csrf
        <input type="text" name="bio" value="{{ $user->bio ?? '' }}">
        <button type="submit">Mettre à jour</button>
    </form>

    @if(auth()->user()->profile_picture)
        <p><strong>Photo de profil :</strong></p>
        <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" alt="Profile Picture" width="150">
    @else
        <p>Aucune photo de profil</p>
    @endif

    <a href="{{ route('logout') }}">Se déconnecter</a>
</div>

<!-- Formulaire pour télécharger une nouvelle image -->
<form action="{{ url('/upload-image') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="image" required>
    <button type="submit">Upload Image</button>
</form>


