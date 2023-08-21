<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Twoje Wiadomości') }}
        </h2>
    </x-slot>

    @foreach ($news as $item)
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="px-2">{{ $item->channel->name }}</div>
                    <div  class="px-6 py-4 whitespace-nowrap text-lg text-black-500">
                        {{ $item->title }}
                    </div>
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ $item->content }}
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</x-app-layout>