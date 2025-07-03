<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Task details public view') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap"><b>Name</b></td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $task->name }}</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap"><b>Descrition</b></td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $task->description }}</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap"><b>Due Date</b></td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $task->due_date }}</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap"><b>Status</b></td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $task->status->name }}</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap"><b>Priority</b></td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $task->priority->name }}</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap"><b>Created at</b></td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $task->created_at }}</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap"><b>Updated at</b></td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $task->updated_at }}</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap"><b>Owner</b></td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $task->user->name }}</td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
