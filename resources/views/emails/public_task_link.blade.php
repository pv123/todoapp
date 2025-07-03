<h1>Public task view</h1>

<p>You can view task without login</p>

<p>
    <a href="{{ route('tasks.public', $task->public_token) }}">
        {{ route('tasks.public', $task->public_token) }}
    </a>
</p>

<p>Valid through: {{ $task->public_token_expires_at?->format('d.m.Y H:i') ?? 'without date' }}</p>
