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

        @if ($errors->any())
            @foreach ($errors->all() as $error)
              <p style="color: red">Update failed: {{$error}}</p>
            @endforeach
          @endif

      <!-- Post Edit Form -->
      <form action="/post/{{$post->post_unique_id}}/update" method="POST">

        @method('patch')
        @csrf

          <div class="text-gray-700 font-normal w-full">
             <textarea
               class="block w-full p-2 pt-2 text-gray-900 rounded-lg border-none outline-none focus:ring-0 focus:ring-offset-0"
               name="post_description"
               value="{{old('post_description')}}"
               rows="2">{{$post->post_description}}</textarea>
           </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
          <a href="/dashboard" class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>
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