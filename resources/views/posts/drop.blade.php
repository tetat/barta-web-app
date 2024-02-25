<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0" />
    
      @include('includes.styles')

  </head>
  <body class="bg-gray-100">
    <header>
      <!-- Navigation -->
      
      @include('layouts.navigation')

    </header>

    <main
      class="container justify-center max-w-xl mx-auto space-y-8 mt-8 px-2 md:px-0 min-h-screen">
      <!-- Post Drop Form -->

      <form action="/destroy/{{$post_unique_id}}" method="POST">

        @method('delete')
        @csrf

        <p class="text-3xl">Are you sure to delete this post?</p>
        <p class="text-xl">You will never get back this post again!!!</p>
        
        <p class="mt-10 flex items-center gap-4">
            <a href="/" class="text-xl text-white bg-gray-600 rounded px-4 py-2 hover:text-gray-800">Cancel</a>

            <span class="text-xl"> | </span>
            
            <button type="submit"
               class="text-xl text-white bg-red-600 rounded px-4 py-2 hover:text-gray-800">
               Delete
            </button>
        </p>
        

      </form>
    </main>
  </body>
</html>