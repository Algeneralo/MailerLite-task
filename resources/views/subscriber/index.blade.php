<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Subscribers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('subscribers.create')}}" class="btn btn-primary mb-3">New Subscriber</a>
            <subscribers-list></subscribers-list>
        </div>
    </div>
</x-app-layout>
