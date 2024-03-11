<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Edit Profile') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("This information will be displayed publicly so be careful what you share.") }}
        </p>
    </header>

    @if (Session::has('success'))
      <div class="p-4 mb-4 text-sm text-white rounded-lg bg-green-500 dark:bg-gray-800" role="alert">
        {{Session::get('success')}}
      </div>
    @endif

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form 
      action="{{ route('profile.update', Auth::user()->username) }}"
      method="POST"
      enctype="multipart/form-data">

        @method('patch')
        @csrf

        @if ($errors->any())
            @foreach ($errors->all() as $error)
              <p style="color: red">Update failed: {{$error}}</p>
            @endforeach
          @endif

        <div class="space-y-12">
          <div class="border-b border-gray-900/10 pb-12">

            <div class="mt-10 border-b border-gray-900/10 pb-12">
              <div class="col-span-full mt-10 pb-10">
                <label
                  for="photo"
                  class="block text-sm font-medium leading-6 text-gray-900"
                  >Photo</label
                >
                <div class="mt-2 flex items-center gap-x-3">
                  <input
                    class="hidden"
                    type="file"
                    name="avatar"
                    id="avatar" />
                  <img
                    class="h-32 w-32 border-2 rounded-full"
                    src="{{ Auth::user()->getFirstMediaUrl('avatar') ? asset('/storage' . explode('/storage', Auth::user()->getFirstMediaUrl('avatar'))[1]) : asset('images/poultry.png')}}"
                    alt="{{Auth::user()->name}}" />
                  <label for="avatar">
                    <div
                      class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                      Change
                    </div>
                  </label>
                </div>
                @error('avatar')
                  <small style="color: red">{{$message}}</small>
                  @enderror
              </div>

              <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="col-span-full">
                  <label
                    for="name"
                    class="block text-sm font-medium leading-6 text-gray-900"
                    >Name</label
                  >
                  <div class="mt-2">
                    <input
                      type="text"
                      name="name"
                      value="{{Auth::user()->name}}"
                      id="name"
                      autocomplete="given-name"
                      class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6" />
                  </div>
                  @error('name')
                  <small style="color: red">{{$message}}</small>
                  @enderror
                </div>

                <div class="col-span-full">
                  <label
                    for="email"
                    class="block text-sm font-medium leading-6 text-gray-900"
                    >Email address</label
                  >
                  <div class="mt-2">
                    <input
                      id="email"
                      name="email"
                      value="{{Auth::user()->email}}"
                      type="email"
                      autocomplete="email"
                      class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6" />
                  </div>
                  @error('email')
                    <small style="color: red">{{$message}}</small>
                  @enderror
                </div>
              </div>
            </div>

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
              <div class="col-span-full">
                <label
                  for="bio"
                  class="block text-sm font-medium leading-6 text-gray-900"
                  >Bio</label
                >
                <div class="mt-2">
                  <textarea
                    id="bio"
                    name="bio"
                    rows="3"
                    class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6">{{Auth::user()->bio}}</textarea
                  >
                </div>
                <p class="mt-3 text-sm leading-6 text-gray-600">
                  Write a few sentences about yourself.
                </p>
              </div>
              @error('bio')
                <small style="color: red">{{$message}}</small>
              @enderror
            </div>
          </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
          <a href="/" class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>
          <button
            type="submit"
            class="rounded-md bg-gray-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">
            Save
          </button>
        </div>
      </form>
      <!-- /Profile Edit Form -->
</section>
