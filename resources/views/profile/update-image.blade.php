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
        
        @if (Session::has('success'))
        <div class="p-4 mb-4 text-sm text-white rounded-lg bg-green-500 dark:bg-gray-800" role="alert">
            {{Session::get('success')}}
        </div>
        @endif

      <!-- Post Edit Form -->
      <form action="{{route('image.update')}}" enctype="multipart/form-data" method="POST">

        @method('patch')
        @csrf

        @if ($errors->any())
            @foreach ($errors->all() as $error)
              <p class="text-lg mb-4" style="color: red">Update failed: {{$error}}</p>
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
          <a href="/u/{{Auth::user()->username}}" class="rounded-md bg-gray-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">Cancel</a>
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