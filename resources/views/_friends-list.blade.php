<div class="bg-gray-200 border border-gray-300 rounded-lg py-4 px-6">
    <h3 class="font-bold text-xl mb-4">Following</h3>
    <ul>
        @forelse(auth()->user()->follows as $user)
            <li class="{{ $loop->last ? '' : 'mb-4' }}" {{ testAttribute('following-friend') }}>
                <div>
                    <a href="{{ $user->path() }}" {{ testAttribute('following-list-anchor-' . $user->id) }} class="flex items-center text-sm">
                        <img src="{{ $user->avatar }}" {{ testAttribute('following-list-image-' . $user->id) }} width="40" height="40" class="rounded-full mr-2" alt="">{{ $user->name }}
                    </a>
                </div>
            </li>
        @empty
            <li>No friends yet.</li>
        @endforelse
    </ul>
</div>
