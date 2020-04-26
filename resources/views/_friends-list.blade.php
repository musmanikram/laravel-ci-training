<div class="bg-gray-200 border border-gray-300 rounded-lg py-4 px-6">
    <h3 class="font-bold text-xl mb-4">Following</h3>
    <ul>
        @foreach(auth()->user()->follows as $user)
            <li class="mb-4">
                <div>
                    <a href="{{ route('profile', $user->name) }}" class="flex items-center text-sm">
                        <img src="{{ $user->avatar }}" width="40" height="40" class="rounded-full mr-2" alt="">{{ $user->name }}
                    </a>
                </div>
            </li>
        @endforeach
    </ul>
</div>
