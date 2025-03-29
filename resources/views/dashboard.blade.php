<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full flex-row gap-4">
        <!-- ToDo Section -->
        <div class="flex-1 flex flex-col gap-4 rounded-xl">
            <h2>ToDo</h2>
            <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <ul>
                    @foreach (Auth::user()->todos as $todo)
                        <li>{{ $todo->title }}</li>
                    @endforeach
                </ul>

                <form action="{{ route('todos.store') }}" method="POST" class="absolute bottom-0 left-0 right-0 flex items-center gap-2 p-4">
                    @csrf
                    <input type="text" name="title" placeholder="New Todo" class="flex-1 rounded border border-neutral-300 dark:border-neutral-700 dark:bg-neutral-800 dark:text-white">
                    <button type="submit" class="rounded bg-blue-500 px-4 py-2 text-white">Add</button>
                </form>
            </div>
        </div>

        <!-- Notes Section -->
        <div class="flex-1 flex flex-col gap-4 rounded-xl">
            <h2>Notes</h2>
            <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <ul>
                    @foreach (Auth::user()->notes as $note)
                        <li>{{ $note->title }}</li>
                    @endforeach
                </ul>

                <form action="{{ route('notes.store') }}" method="POST" class="absolute bottom-0 left-0 right-0 flex items-center gap-2 p-4">
                    @csrf
                    <input type="text" name="title" placeholder="New Note" class="flex-1 rounded border border-neutral-300 dark:border-neutral-700 dark:bg-neutral-800 dark:text-white">
                    <button type="submit" class="rounded bg-blue-500 px-4 py-2 text-white">Add</button>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
