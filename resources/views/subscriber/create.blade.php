<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Subscriber') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <subscriber-create :states='@json($states)' :field_types='@json($field_types)'></subscriber-create>
        </div>
    </div>
</x-app-layout>
