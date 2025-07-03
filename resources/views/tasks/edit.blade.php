<x-app-layout>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.10.0/dist/js/bootstrap-datepicker.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit task') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('tasks.update', $task) }}" method="POST">
                        @csrf
                        @method('PUT')

                        
                        
                            <div>
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" value="{{ old('name', $task->name) }}" required autofocus autocomplete="name" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />   
                            </div>

                            <div>
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea
                                name="description"
                                id="description"
                                rows="4"
                                class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                placeholder="">{{ old('description', $task->description ?? '') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                            <div>
                                <x-input-label for="due_date" :value="__('Due date')" />
                                <x-text-input id="due_date" name="due_date" type="text" class="mt-1 block w-full datepicker" value="{{ old('due_date', $task->due_date) }}"  autocomplete="due_date" />
                                <x-input-error class="mt-2" :messages="$errors->get('due_date')" />
                            </div>
                        
                        <div class="">
                            <x-input-label for="status_id" :value="__('Status')" />
                            <select name="status_id" id="status_id" class="">
                                @foreach($statuses as $s)
                                <option value="{{ $s->id }}" {{ $task->status_id == $s->id ? 'selected' : '' }}>
                                    {{ $s->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <x-input-label for="priority_id" :value="__('Priority')" />
                            <select name="priority_id" id="priority_id" class="">
                                @foreach($priorities as $p)
                                <option value="{{ $p->id }}" {{ $task->priority_id == $p->id ? 'selected' : '' }}>
                                    {{ $p->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <x-primary-button>{{ __('Update task') }}</x-primary-button>
                        <a href="{{ route('tasks.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Cancel</a>
                    </form>
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