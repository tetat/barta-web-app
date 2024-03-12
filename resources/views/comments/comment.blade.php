<!-- Barta User Comments Container -->
<article
  class="bg-white border-2 border-black rounded-lg shadow mx-auto max-w-none px-4 py-2 sm:px-6 min-w-full divide-y">
  <!-- Comments -->

  @foreach ($post->comments as $comment)
  
  <div class="py-4">
    <!-- Barta User Comments Top -->
    <header>
      <div class="flex items-center justify-between">
        <div class="flex items-center space-x-3">
          <!-- User Info -->
          <!-- User Avatar -->
          <div class="flex-shrink-0">
            <img
              class="h-10 w-10 rounded-full object-cover"
              src="{{ $comment->user->getFirstMediaUrl('avatar') ? asset('/storage' . explode('/storage', $comment->user->getFirstMediaUrl('avatar'))[1]) : asset('images/poultry.png')}}"
              alt="{{$comment->user->name}}" />
          </div>
          <!-- /User Avatar -->
          <div class="text-gray-900 flex flex-col min-w-0 flex-1">
            <a
              href="{{ route('profile.show', $comment->user->username) }}"
              class="hover:underline font-semibold line-clamp-1">
              {{$comment->user->name}}
            </a>

            <span
              class="hover:underline text-sm text-gray-500 line-clamp-1">
              {{'@' . $comment->user->username}}
            </span>
          </div>
          <!-- /User Info -->
        </div>
        @if (Auth::user()->username === $comment->user->username)
        <!-- Card Action Dropdown -->
        <div
          class="flex flex-shrink-0 self-center"
          x-data="{ open: false }">
          <div class="relative inline-block text-left">
            <div>
              <button
                @click="open = !open"
                type="button"
                class="-m-2 flex items-center rounded-full p-2 text-gray-400 hover:text-gray-600"
                id="menu-0-button">
                <span class="sr-only">Open options</span>
                <svg
                  class="h-5 w-5"
                  viewBox="0 0 20 20"
                  fill="currentColor"
                  aria-hidden="true">
                  <path
                    d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM10 8.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM11.5 15.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0z"></path>
                </svg>
              </button>
            </div>
            <!-- Dropdown menu -->
            <div
              x-show="open"
              @click.away="open = false"
              class="absolute right-0 z-10 mt-2 w-18 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
              role="menu"
              aria-orientation="vertical"
              aria-labelledby="user-menu-button"
              tabindex="-1">

              <!-- Update comment -->
              @include('comments.partials.edit-comment-form')
              <!-- Delete comment -->
              @include('comments.partials.drop-comment-form')
              
            </div>
          </div>
        </div>
        <!-- /Card Action Dropdown -->
        @endif
      </div>
    </header>

    <!-- Content -->
    <div class="py-4 text-gray-700 font-normal">
      <pre>{{$comment->comment_description}}</pre>
    </div>

    <!-- Date Created -->
    <div class="flex items-center gap-2 text-gray-500 text-xs">
      <span class="">6m ago</span>
    </div>
  </div>
  @endforeach

  <!-- /Comments -->
</article>
<!-- /Barta User Comments -->