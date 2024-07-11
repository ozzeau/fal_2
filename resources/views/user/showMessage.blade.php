@include('assets.header')
@include('assets.navbar')

<div class="flex h-screen">
    <!-- Sidebar -->
    <nav class="flex-none w-64 items-start px-5 py-2 hidden md:flex border-r-4 border-purple-500" style="border-top-right-radius: 100px; border-bottom-right-radius: 100px;">
        @include('assets.sidebar')
    </nav>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        @php
        $latestMessages = $messages->groupBy('receiver_id')
        ->map(function ($group) {
        return $group->sortByDesc('created_at')->first();
        });
        @endphp
        <!-- Messages Page Content -->
        <div class="flex-1 flex overflow-hidden">
            <!-- Messages List -->
            <aside class="w-full md:w-64 text-white overflow-y-auto mt-12 md:px-4">
                <div class="p-4">
                    <div class="flex items-center mb-4">
                        <img src="{{ !empty(Auth::user()->image) ? asset('storage/users/' . Auth::user()->image) : asset('storage/icons/profile-placeholder.svg')}}" alt="Profile" class="rounded-full w-12 h-12">
                        <div class="ml-4">
                            <p class="font-semibold">{{ Auth::user()->Fname }}</p>
                            <p class="text-gray-400">{{ Auth::user()->username }}</p>
                        </div>
                    </div>
                    <div>
                        <h2 class="font-semibold text-lg mb-2">Messages</h2>
                        @php
                        $displayedUsers = [];
                        @endphp

                        @foreach ($latestMessages as $message)
                        @php
                        $otherUser = $message->sender_id == Auth::id() ? $message->receiver : $message->sender;
                        @endphp

                        @if (!in_array($otherUser->id, $displayedUsers))
                        @php
                        $displayedUsers[] = $otherUser->id;
                        @endphp

                        <div class="space-y-4">
                            <div class="flex items-center cursor-pointer p-2 hover:bg-gray-700 rounded">
                                <img src="{{ !empty($otherUser->image) ? asset('storage/users/' . $otherUser->image) : asset('storage/icons/profile-placeholder.svg') }}" alt="Profile" class="rounded-full w-10 h-10">
                                <a href="message/{{$otherUser->id}}" class="ml-4">
                                    <p class="font-semibold">{{ $otherUser->username }}</p>
                                    <p class="text-gray-400 text-sm">{{ $message->content }}</p>
                                </a>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
            </aside>

            <!-- Message Detail -->
            <main class="flex-1 bg-black text-white flex flex-col items-center justify-center md:ml-64">
                <div class="text-center px-4">
                    <p class="text-lg font-semibold">Vos messages</p>
                    <p class="text-gray-400">Envoyez des photos et des messages privés à un ami ou à un groupe.</p>
                    <button id="openModalBtn" class="mt-4 px-4 py-2 bg-blue-500 hover:bg-blue-600 rounded text-white">Envoyer un message</button>
                </div>
            </main>
        </div>
    </div>
</div>

<section class="bottom-bar fixed bottom-0 w-full">
    @include('assets.bottombar')
</section>

<!-- Modal -->
<div id="messageModal" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg p-6 w-2/3 md:w-1/3">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-black">Envoyer un message</h2>
            <button id="closeModalBtn" class="text-gray-600 hover:text-gray-800">&times;</button>
        </div>
        <input type="text" id="userSearch" class="mt-4 p-2 border border-gray-300 rounded w-full text-black" placeholder="Rechercher des utilisateurs...">
        <div id="searchResults" class="mt-4">
            <!-- Search results will be displayed here -->
            @foreach ($all_users as $user)
            <div class="flex items-center cursor-pointer p-2 hover:bg-gray-100 rounded user-item" data-username="{{ $user->username }}">
                <img src="{{ !empty($user->image) ? asset('storage/users/' . $user->image) : asset('storage/icons/profile-placeholder.svg') }}" alt="{{ $user->username }}" class="w-10 h-10 rounded-full">
                <a href="message/{{$user->id}}" class="ml-4">
                    <p class="font-semibold text-black">{{ $user->username }}</p>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>


<script>
    document.getElementById('openModalBtn').addEventListener('click', function() {
        document.getElementById('messageModal').classList.remove('hidden');
    });

    document.getElementById('closeModalBtn').addEventListener('click', function() {
        document.getElementById('messageModal').classList.add('hidden');
    });

    document.getElementById('userSearch').addEventListener('input', function() {
        let query = this.value.toLowerCase();
        let userItems = document.querySelectorAll('.user-item');

        userItems.forEach(item => {
            let username = item.getAttribute('data-username').toLowerCase();
            if (username.includes(query)) {
                item.classList.remove('hidden');
            } else {
                item.classList.add('hidden');
            }
        });
    });
</script>