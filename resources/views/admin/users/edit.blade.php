<x-layouts.store title="Admin | Edit User">
    <h1 class="text-3xl font-bold">Edit User</h1>

    <form method="POST" action="{{ route('admin.users.update', $user) }}" class="mt-6 rounded-xl bg-white p-5 shadow space-y-4">
        @csrf
        @method('PATCH')
        <div>
            <label class="mb-1 block text-sm font-medium">Name</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full rounded border border-slate-300">
        </div>
        <div>
            <label class="mb-1 block text-sm font-medium">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full rounded border border-slate-300">
        </div>
        <div class="flex items-center gap-2">
            <input id="is_admin" type="checkbox" name="is_admin" value="1" @checked(old('is_admin', $user->is_admin))>
            <label for="is_admin" class="text-sm">Administrator</label>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="rounded bg-slate-900 px-5 py-2 font-semibold text-white">Update</button>
            <a href="{{ route('admin.users.index') }}" class="rounded bg-slate-200 px-5 py-2 font-semibold">Cancel</a>
        </div>
    </form>
</x-layouts.store>
