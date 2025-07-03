@component('mail::message')
# Task Reminder

Hello,

This is a reminder for your task: **{{ $task->name }}**  
Due date: {{ $task->due_date ? $task->due_date->format('F j, Y') : 'No due date set' }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent