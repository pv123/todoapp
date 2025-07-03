<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Task details') }}
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

                    <p>
                        @if ($task->public_token)
                    <p class="">
                        Public link: 
                        <a href="{{ route('tasks.public', $task->public_token) }}" class="" target="_blank">
                            {{ route('tasks.public', $task->public_token) }}
                        </a>
                    </p>

                    <form method="POST" action="{{ route('tasks.token.revoke', $task) }}">
                        @csrf
                        @method('DELETE')
                        <x-danger-button type="submit" class="">Delete public link</x-danger-button>
                    </form>
                    @else
                    <form method="POST" action="{{ route('tasks.token.generate.custom', $task) }}" class="">
                        @csrf
                        <label for="email" class="block text-sm font-medium text-gray-700">Send token to email:</label>
                        <input type="email" name="email" id="email" required
                               class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

                        <x-primary-button type="submit" class="">
                            {{ __('Generate and send') }}
                        </x-primary-button>

                    </form>

                    @if (session('success'))
                    <p class="text-green-600">{{ session('success') }}</p>
                    @endif

                    @endif
                    <div>
                        <br/>
                        <a href="{{ route('tasks.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Back to list</a>
                        <a href="{{ route('tasks.edit', $task) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Edit</a>

                    </div>
                    </p>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
