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
      
      @include('partials.navbar')

    </header>

    <main
      class="container justify-center max-w-xl mx-auto space-y-8 mt-8 px-2 md:px-0 min-h-screen">
      <!-- Post Edit Form -->

      <form action="/user/{{$user->username}}/profile_picture" method="POST">

        @method('patch')
        @csrf

        @if ($errors->any())
            @foreach ($errors->all() as $error)
              <p style="color: red">Update failed: {{$errors->all()[0]}}</p>
            @endforeach
          @endif

          <!-- Avatar -->
         <div class="relative">
           <img
             class="border-2 border-gray-800"
             src="{{asset($user->profile_picture)}}"
             alt="{{ $user->username }}"
             width="200px"
             height="150px" />
           
           <span
             class="bottom-2 right-4 absolute w-3.5 h-3.5 bg-green-400 border-2 border-white dark:border-gray-800 rounded-full"></span>
         </div>

         <div class="mt-4">
         <label
                 for="selectImage"
                 class="my-4 text-xl py-2 text-yellow-600">Select an image to change...
               </label>
         <input
                 type="file"
                 name="image"
  
                 id="selectImage"
                 class="" />
         </div>

        <div class="mt-6 flex items-center justify-start gap-x-6">
          <a href="/" class="rounded-md bg-gray-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">Cancel</a>
          <button
            type="submit"
            class="rounded-md bg-gray-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">
            Save
          </button>
        </div>
      </form>
      <!-- /Profile Edit Form -->
    </main>
  </body>
</html>