<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <title>{{ config('app.name', 'Laravel') }}</title>
        
        <!-- Styles -->
        @include('includes.styles')
        
    </head>
    <body class="antialiased">

    <header>
      
      @include('layouts.navigation')

    </header>

        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">

            <main class="container max-w-xl mx-auto space-y-8 mt-8 px-2 md:px-0 min-h-screen">
                <div class="text-center p-12 border border-gray-800 rounded-xl">
                    <h1 class="text-3xl justify-center items-center">Welcome to Barta!</h1>
                </div>
            </main>
        </div>
        @include('layouts/footer')
    </body>
</html>
