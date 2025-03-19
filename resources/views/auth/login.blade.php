<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/app.css">

    <title>Document</title>
</head>
<body>
<form method="Post" action="{{ route('api.login') }}">
    @csrf
    <input type="email" name="email" placeholder="Email">
    <input type="password" name="password" placeholder="Password">
    <button type="submit">Login</button>

    <script>axios.post('/api/users/login', {
    email: this.email,
    password: this.password
})
.then(response => {
    // Sauvegarder le token dans localStorage ou dans une autre méthode de gestion de session
    localStorage.setItem('token', response.data.token);
    localStorage.setItem('user', JSON.stringify(response.data.user));
    
    // Rediriger vers le profil
    window.location.href = '/profile';
})
.catch(error => {
    console.error('Login failed', error);
});
</script>
</body>
</html>