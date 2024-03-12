<section class="space-y-6">
    <button
        class="block w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'edit-post')"
    >{{ __('Edit') }}</button>

    <x-modal class="" name="edit-post" :show="$errors->editPost->isNotEmpty()" focusable>
        <form method="post" action="{{ route('post.update', $post->post_unique_id) }}" class="p-6 h-auto">
            @csrf
            @method('patch')

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Edit Post') }}
            </h2>

            <div class="mt-6">
              <textarea
                class="block w-full p-2 pt-2 text-gray-900 border border-sm rounded-lg border-neutral-300 ring-offset-background outline-none focus:ring-0 focus:ring-offset-0"
                name="post_description"
                rows="2">{{$post->post_description}}</textarea>

                <x-input-error :messages="$errors->editPost->get('post_description')" class="mt-2" />
            </div>

            <div class="mt-4 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-primary-button class="ms-3">
                    {{ __('Save') }}
                </x-primary-button>
            </div>
        </form>
    </x-modal>
</section>
