<?php /* resources/views/welcome.blade.php */ ?>
@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-4">Shopping List</h1>

    <ul class="space-y-2">
        @foreach ($items as $item)
        <li class="flex items-center justify-between p-3 bg-white rounded shadow-sm">
            <div x-data="{ completed: {{ $item->is_completed ? 'true' : 'false' }} }" class="flex items-center space-x-3">
                <label class="flex items-center space-x-2">
                    <input
                        type="checkbox"
                        x-model="completed"
                        @change="(function(){ const prev = completed; window.toggleItemCompleted({{ $item->id }}, completed).catch(()=>{ completed = prev; }); })()"
                        class="form-checkbox h-5 w-5 text-indigo-600"
                        aria-label="Mark {{ $item->name }} as completed"
                    >
                </label>

                <span :class="completed ? 'line-through text-gray-400' : 'text-gray-900'">{{ $item->name }}</span>
            </div>

            <div class="text-sm text-gray-500">
                @if ($item->is_completed)
                    Completed
                @endif
            </div>
        </li>
        @endforeach
    </ul>
</div>
@endsection
