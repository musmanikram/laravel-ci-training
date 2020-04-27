<div class="flex p-4 border-b border-b-gray-400" {{ testAttribute('tweet-id-'.$tweet->id) }}>
    <div class="mr-2 flex-shrink-0">
        <a href="{{ $tweet->user->profilePath() }}">
            <img
                src="{{ $tweet->user->avatar }}"
                alt=""
                class="rounded-full mr-2"
                width="50"
                height="50"
                {{ testAttribute('tweet-user-img-'.$tweet->user->id) }}
            >
        </a>
    </div>

    <div>
        <a href="{{ $tweet->user->profilePath() }}">
            <h5 class="font-bold mb-2" {{ testAttribute('tweet-user-name-'.$tweet->user->id) }}>
                {{ $tweet->user->name }}
            </h5>
        </a>

        <p class="text-sm" {{ testAttribute('tweet-body-'.$tweet->user->id) }}>
            {{ $tweet->body }}
        </p>
    </div>
</div>
