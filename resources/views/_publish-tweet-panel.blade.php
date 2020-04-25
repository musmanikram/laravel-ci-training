<div class="border border-blue-400 rounded-lg px-8 py-6 mb-8">
    <form method="POST" action="{{ url('tweets') }}">
        @csrf

        <textarea
            name="body"
            class="w-full"
            placeholder="What's up doc?"
            required
            {{ testAttribute('tweet-input') }}
        ></textarea>

        <hr class="my-4">

        <footer class="flex justify-between">
            <img
                src="{{ auth()->user()->avatar }}"
                alt="your avatar"
                class="rounded-full mr-2"
            >

            <button
                type="submit"
                class="bg-blue-500 rounded-lg shadow py-2 px-2 text-white"
                {{ testAttribute('tweet-submit-button') }}
            >
                Tweet-a-roo!
            </button>
        </footer>
    </form>

    @error('body')
        <p class="text-red-500 text-sm mt-2" {{ testAttribute('tweet-error') }}>{{ $message }}</p>
    @enderror
</div>
