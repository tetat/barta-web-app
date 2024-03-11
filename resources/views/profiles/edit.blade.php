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
      
      @include('layouts.navigation')

    </header>

    <main
      class="container max-w-xl mx-auto space-y-8 mt-8 px-2 md:px-0 min-h-screen">
      <!-- Profile Edit Form -->
      @include('profiles.partials.edit-profile-information-form')

      <hr>

      <!-- Password Update -->
      @include('profiles.partials.edit-password-form')

      <hr>

      <!-- Delete Your Account -->
      @include('profiles.partials.delete-user-form')
    </main>

    <!-- Footer section -->
    @include('layouts.footer')
    
  </body>
</html>