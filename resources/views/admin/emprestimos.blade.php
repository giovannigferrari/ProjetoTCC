<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BIBLIO-TEK - Dashboard</title>
    <!-- Tailwind CSS & Ícones do Bootstrap -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body class="bg-gray-100 font-sans antialiased">

    <!-- Container Flexbox (Sidebar + Conteúdo Lado a Lado) -->
    <div class="flex min-h-screen">
        
        @include('admin.sidebar')
    </div>
</body>
</html>