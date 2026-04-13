@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6" x-data="{ showDeleted: false }">
  <div class="flex items-center justify-between mb-4">
    <h1 class="text-2xl font-semibold">Users</h1>
    <div class="flex items-center space-x-2">
      <label class="flex items-center space-x-2 text-sm text-gray-600">
        <input type="checkbox" x-model="showDeleted" class="form-checkbox h-4 w-4 text-indigo-600" />
        <span>Show deleted</span>
      </label>
    </div>
  </div>

  <div class="bg-white shadow rounded-lg overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
      <thead class="bg-gray-50">
        <tr>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
          <th class="px-6 py-3"></th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
        @foreach($users as $user)
          <tr x-show="{{ $user->deleted_at ? 'showDeleted' : '!showDeleted' }}" class="{{ $user->deleted_at ? 'opacity-70 bg-red-50' : '' }}">
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->email }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm">
              @if($user->deleted_at)
                <span class="text-red-600">Deleted at {{ $user->deleted_at->format('Y-m-d H:i') }}</span>
              @else
                <span class="text-green-600">Active</span>
              @endif
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
              @if($user->deleted_at)
                <form action="{{ route('users.restore', $user) }}" method="POST" class="inline">
                  @csrf
                  <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs leading-4 font-medium rounded-md text-white bg-yellow-600 hover:bg-yellow-700">Restore</button>
                </form>
              @else
                <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this user?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs leading-4 font-medium rounded-md text-white bg-red-600 hover:bg-red-700">Delete</button>
                </form>
              @endif
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
