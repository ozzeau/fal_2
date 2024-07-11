@include('assets.header')
@include('assets.navbar')

<div class="flex h-screen">
    <div class="flex flex-row h-full w-full overflow-x-hidden">
        <div class="hidden md:flex flex-col py-8 pl-6 pr-2 md:w-64 lg:w-72 bg-black flex-shrink-0">
            <nav class="leftsidebar flex flex-col justify-between items-start px-5 py-2 hidden md:flex border-r-4 border-purple-500" style="border-top-right-radius: 100px; border-bottom-right-radius: 100px;">
                @include('assets.sidebar')
            </nav>
        </div>
        <div class="flex flex-col flex-auto h-full p-6">
            <div class="top-4 left-4 z-50">
                <a href="{{route('home')}}" class="flex items-center justify-center w-8 h-8 bg-purple-500 text-white rounded-full shadow-md hover:bg-purple-600 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
            </div>
            <div class="flex flex-col flex-auto flex-shrink-0 rounded-2xl bg-black h-full p-4">
                <div class="flex flex-col h-full overflow-y-auto mb-4" id="messages">
                    @foreach ($messages as $message)
                    @if ($message->sender_id == Auth::id())
                    <!-- Sender's message -->
                    <div class="col-start-6 col-end-13 p-3 rounded-lg flex justify-end">
                        <div class="flex flex-row-reverse items-center">
                            <div class="flex items-center justify-center h-10 w-10 rounded-full bg-white text-black flex-shrink-0">
                                <img src="{{ !empty($message->sender->image) ?  asset('storage/users/' . $message->sender->image) : asset('storage/icons/profile-placeholder.svg')}}" alt="Profile Image" class="rounded-full h-10 w-10 object-cover">
                            </div>
                            <div class="relative mr-3 text-sm bg-purple-800 py-2 px-4 shadow rounded-xl">
                                <div class="text-white font-bold">{{ $message->sender->username }}</div>
                                <div>{{ $message->content }}</div>
                            </div>
                        </div>
                    </div>
                    @else
                    <!-- Receiver's message -->
                    <div class="col-start-1 col-end-8 p-3 rounded-lg flex justify-start">
                        <div class="flex flex-row items-center">
                            <div class="flex items-center justify-center h-10 w-10 rounded-full bg-white text-black flex-shrink-0">
                                <img src="{{ !empty($message->sender->image) ?  asset('storage/users/' . $message->sender->image) : asset('storage/icons/profile-placeholder.svg') }}" alt="Profile Image" class="rounded-full h-10 w-10 object-cover">
                            </div>
                            <div class="relative ml-3 text-sm bg-gray-800 py-2 px-4 shadow rounded-xl">
                                <div class="text-white font-bold">{{ $message->sender->username }}</div>
                                <div>{{ $message->content }}</div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
                <form id="message-form" action="{{ route('message.send') }}" method="POST" class="flex flex-row items-center h-16 rounded-xl bg-black w-full px-4 -mt-16 md:mt-0 mb-20">
                    @csrf
                    <div class="flex-grow ml-4">
                        <div class="relative w-full">
                            <input type="text" id="message" name="content" class="flex w-full border rounded-xl focus:outline-none focus:border-indigo-300 pl-4 h-10 bg-white text-black" placeholder="Type your message..." required />
                        </div>
                    </div>
                    <div class="ml-4">
                        <input type="hidden" name="receiver_id" value="{{ $user_r->id }}">
                        <button type="submit" class="flex items-center justify-center bg-indigo-500 hover:bg-indigo-600 rounded-xl text-white px-4 py-1 flex-shrink-0">
                            <span>Send</span>
                            <span class="ml-2">
                                <svg class="w-4 h-4 transform rotate-45 -mt-px" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </svg>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<section class="bottom-bar fixed bottom-0 w-full">
    @include('assets.bottombar')
</section>