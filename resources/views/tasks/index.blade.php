<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.10.0/dist/js/bootstrap-datepicker.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your Tasks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">


                    <!DOCTYPE html>

                    <script src="https://cdn.tailwindcss.com"></script>
                    <body class="bg-gray-100">
                        <div class="container mx-auto px-4 py-8">


                            <!-- Search and Add User (Static) -->
                            <div class="flex flex-col md:flex-row justify-between items-center mb-6">
                                <div class="w-full md:w-1/3 mb-4 md:mb-0">

                                </div>
                                @auth
                                <a href="{{ route('tasks.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300">Create New Task</a>
                                @endauth
                            </div>
                            @if($tasks->count())
                            <!-- User Table -->
                            <div class="overflow-x-auto bg-white rounded-lg shadow">
                                <table class="w-full table-auto">
                                    <thead>

                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th><!-- Filter Form -->
                                                <form method="GET" action="{{ route('tasks.index') }}" class="">
                                                    <label for="filter_due_date" class="">Filter by Due Date</label>
                                                    <input type="text" class="datepicker" name="filter_due_date" id="filter_due_date"" value="{{$selected_due_date}}" autocomplete="off">
                                                    <x-primary-button>{{ __('Filter') }}</x-primary-button>
                                                </form>
                                            </th>
                                            <th><!-- Filter Form -->
                                                <form method="GET" action="{{ route('tasks.index') }}" class="">
                                                    <label for="filter_status">Filter by Status:</label>
                                                    <select name="filter_status_id" id="filter_status_id" class="">
                                                        <option value=""{{ $selected_status == "" ? 'selected="' : '' }}>-- All --</option>
                                                                @foreach($statuses as $s)
                                                                <option value="{{ $s->id }}" {{ $selected_status == $s->id ? 'selected="' : '' }}">
                                                            {{ $s->name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    <x-primary-button>{{ __('Filter') }}</x-primary-button>
                                                </form>
                                            </th>
                                            <th>
                                                <form method="GET" action="{{ route('tasks.index') }}" class="">
                                                    <label for="filter_priority">Filter by Priority:</label>
                                                    <select name="filter_priority_id" id="filter_priority_id" class="">
                                                        <option value=""{{ $selected_priority == "" ? 'selected="' : '' }}>-- All --</option>
                                                                @foreach($priorities as $p)
                                                                <option value="{{ $p->id }}" {{ $selected_priority == $p->id ? 'selected="' : '' }}>
                                                            {{ $p->name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    <x-primary-button>{{ __('Filter') }}</x-primary-button>
                                                </form>
                                            </th>
                                            <th></th>
                                        </tr>

                                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                            <th class="py-3 px-6 text-left">Name</th>
                                            <th class="py-3 px-6 text-left">Description</th>
                                            <th class="py-3 px-6 text-left">Due date</th>
                                            <th class="py-3 px-6 text-left">Status</th>
                                            <th class="py-3 px-6 text-left">Priority</th>
                                            <th class="py-3 px-6 text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-gray-600 text-sm">
                                        @foreach ($tasks as $task)
                                        <tr class="hover:bg-gray-200">
                                            <td>{{ $task->name }}</td>
                                            <td>{{ $task->description }}</td>
                                            <td>{{ $task->due_date }}</td>
                                            <td>{{ $task->status->name }}</td>
                                            <td>{{ $task->priority->name }}</td>
                                            <td class='flex justify-center items-center'>
                                                <a href="{{ route('tasks.show', $task) }}" class="px-2 text-blue-600 hover:underline">View</a>
                                                <a href="{{ route('tasks.edit', $task) }}" class="px-2 text-green-600 hover:underline">Edit</a>
                                                <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="m-0"
                                                      onsubmit="return confirm('Are you sure you want to delete this task?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class=" text-red-600 hover:underline" type="submit">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </body>
                    </html>

                    @else
                    <p>No task found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        startDate: '-3d'
    });
</script>