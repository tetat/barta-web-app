<section class="space-y-6">
    <button
        class="block w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'edit-comment')"
    >{{ __('Edit') }}</button>

    <x-modal class="" name="edit-comment" :show="$errors->editComment->isNotEmpty()" focusable>
        <form method="post" action="{{ route('comment.update', $comment->id) }}" class="p-6 h-auto">
            @csrf
            @method('patch')

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Edit Comment') }}
            </h2>

            <div class="mt-6">
            <textarea
                class="block w-full p-2 pt-2 text-gray-900 border border-sm rounded-lg border-neutral-300 ring-offset-background outline-none focus:ring-0 focus:ring-offset-0"
                name="comment_description"
                rows="2">{{$comment->comment_description}}</textarea>

                <x-input-error :messages="$errors->editComment->get('comment_description')" class="mt-2" />
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
