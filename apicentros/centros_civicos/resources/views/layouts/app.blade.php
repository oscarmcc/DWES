<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <title>@yield('title', 'Laravel')</title>



<!-- Styles -->
<style>
body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

header {
    background-color: #333;
    color: #fff;
    padding: 10px 0;
}

nav {
    display: flex;
    justify-content: center;
    gap: 20px;
}

nav a {
    color: #fff;
    text-decoration: none;
    padding: 10px 20px;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

nav a:hover {
    background-color: #555;
}

main {
    padding: 20px;
    max-width: 1200px;
    margin: 0 auto;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
}

h1, h2, h3, h4, h5, h6 {
    color: #333;
}

p {
    line-height: 1.6;
    color: #666;
}
</style></head>
<body>
    <header>
        <nav>
            <a href="{{ route('centros.index') }}">Centros Cívicos</a>
        </nav>
    </header>

    <main>
        @yield('content') <!-- Aquí se inyectará el contenido de las vistas -->
    </main>
</body>
</html>