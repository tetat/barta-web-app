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
      
      @include('partials.guest_navbar')

    </header>

    <main
      class="container max-w-xl mx-auto space-y-8 mt-8 px-2 md:px-0 min-h-screen">

      <div class="text-center p-12 border border-gray-800 rounded-xl">
        <h1 class="text-3xl justify-center items-center">Welcome to Barta!</h1>
      </div>
    </main>

    <footer class="shadow bg-black mt-10">
      <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
        <div class="sm:flex sm:items-center sm:justify-between">
          <a
            href="https://github.com/alnahian2003"
            class="flex items-center mb-4 sm:mb-0">
            <span
              class="self-center text-2xl font-semibold whitespace-nowrap text-white"
              >Barta</span
            >
          </a>
          <ul
            class="flex flex-wrap items-center mb-6 text-sm font-medium sm:mb-0 text-gray-100">
            <li>
              <a
                href="#"
                class="mr-4 hover:underline md:mr-6"
                >About</a
              >
            </li>
            <li>
              <a
                href="#"
                class="mr-4 hover:underline md:mr-6"
                >Privacy Policy</a
              >
            </li>
            <li>
              <a
                href="#"
                class="mr-4 hover:underline md:mr-6"
                >Licensing</a
              >
            </li>
            <li>
              <a
                href="#"
                class="hover:underline"
                >Contact</a
              >
            </li>
          </ul>
        </div>
        <hr class="my-6 sm:mx-auto border-gray-700 lg:my-8" />
        <span class="block text-sm sm:text-center text-gray-200"
          >© 2023
          <a
            href="https://github.com/alnahian2003"
            class="hover:underline"
            >Barta</a
          >. All Rights Reserved.</span
        >
      </div>
    </footer>
  </body>
</html>