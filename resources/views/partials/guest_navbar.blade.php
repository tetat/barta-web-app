<!-- Navigation for Guest -->
<nav
  x-data="{ mobileMenuOpen: false, userMenuOpen: false }"
  class="bg-white shadow">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="flex h-16 justify-between">
      <div class="flex">
        <div class="flex flex-shrink-0 items-center">
          <a href="/">
            <h2 class="font-bold text-2xl">Barta</h2>
          </a>
        </div>
        <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
          <!-- Current: "border-gray-800 text-gray-900 font-semibold", Default: "border-transparent text-gray-600 hover:border-gray-300 hover:text-gray-800" -->
          <a
            href="#"
            class="inline-flex items-center border-b-2 border-gray-800 px-1 pt-1 text-sm font-semibold text-gray-900"
            >Discover</a
          >
          <a
            href="#"
            class="inline-flex items-center border-b-2 border-transparent px-1 pt-1 text-sm font-medium text-gray-600 hover:border-gray-300 hover:text-gray-800"
            >For you</a
          >
          <a
            href="#"
            class="inline-flex items-center border-b-2 border-transparent px-1 pt-1 text-sm font-medium text-gray-600 hover:border-gray-300 hover:text-gray-800"
            >People</a
          >
        </div>
      </div>
      <div class="hidden sm:ml-6 sm:flex gap-2 sm:items-center">
        <!-- This Button Should Be Hidden on Mobile Devices -->
        <a
            href="/sign_in"
            class="text-gray-900 hover:text-white border-2 border-gray-800 hover:bg-gray-900 focus:ring-2 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center hidden md:block"
            >Login</a
          >
        
          <a
            href="/sign_up"
            class="text-gray-900 hover:text-white border-2 border-gray-800 hover:bg-gray-900 focus:ring-2 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center hidden md:block"
            >Register</a
          >
      </div>

      <div class="-mr-2 flex items-center sm:hidden">
        <!-- Mobile menu button -->
        <button
          @click="mobileMenuOpen = !mobileMenuOpen"
          type="button"
          class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-gray-500"
          aria-controls="mobile-menu"
          aria-expanded="false">
          <span class="sr-only">Open main menu</span>
          <!-- Icon when menu is closed -->
          <svg
            x-show="!mobileMenuOpen"
            class="block h-6 w-6"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            aria-hidden="true">
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>

          <!-- Icon when menu is open -->
          <svg
            x-show="mobileMenuOpen"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="w-6 h-6">
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>

    </div>
  </div>

  <!-- Mobile menu, show/hide based on menu state. -->
  <div
    x-show="mobileMenuOpen"
    class="sm:hidden"
    id="mobile-menu">
    <div class="space-y-1 pt-2 pb-3">
      <!-- Current: "bg-gray-50 border-gray-800 text-gray-700", Default: "border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700" -->
      <a
        href="#"
        class="block border-l-4 border-gray-800 bg-gray-50 py-2 pl-3 pr-4 text-base font-medium text-gray-700"
        >Discover</a
      >
      <a
        href="#"
        class="block border-l-4 border-transparent py-2 pl-3 pr-4 text-base font-medium text-gray-500 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-700"
        >For You</a
      >
      <a
        href="#"
        class="block border-l-4 border-transparent py-2 pl-3 pr-4 text-base font-medium text-gray-500 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-700"
        >People</a
      >
    </div>
    <div class="border-t border-gray-200 pt-4 pb-3">
      
      <div class="mt-3 space-y-1">
        <a
          href="/sign_in"
          class="block px-4 py-2 text-base font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-800"
          >Login</a
        >

        <a
          href="/sing_up"
          class="block px-4 py-2 text-base font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-800"
          >Register</a
        >
      </div>
    </div>
  </div>
</nav>