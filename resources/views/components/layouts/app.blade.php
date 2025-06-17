<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Usuários</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script> 
</head>

<body class="bg-gray-100">
    <div class="min-h-screen">
        {{ $slot }} 
    </div>
    
    @include('components.toast') 
    
    @livewireScripts
</body>

</html>