<section class="space-y-6">
    <button
        class="block w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'delete-post')"
    >{{ __('Delete') }}</button>

    <x-modal class="" name="delete-post" focusable>
        <form method="post" action="{{ route('post.destroy', $post->post_unique_id) }}" class="p-6 h-auto">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Are you sure you want to delete this post?') }}
            </h2>

            <div class="mt-4 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Delete') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
