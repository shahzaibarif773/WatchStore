<x-layouts.store title="Admin | Create Product">
    <h1 class="text-3xl font-bold">Create Product</h1>

    <form method="POST" action="{{ route('admin.products.store') }}" class="mt-6 rounded-xl bg-white p-5 shadow space-y-4">
        @csrf
        <div>
            <label class="mb-1 block text-sm font-medium">Name</label>
            <input type="text" name="name" value="{{ old('name') }}" class="w-full rounded border border-slate-300">
        </div>
        <div>
            <label class="mb-1 block text-sm font-medium">Description</label>
            <textarea name="description" rows="4" class="w-full rounded border border-slate-300">{{ old('description') }}</textarea>
        </div>
        <div class="grid gap-4 md:grid-cols-2">
            <div>
                <label class="mb-1 block text-sm font-medium">Price</label>
                <input type="number" step="0.01" min="0" name="price" value="{{ old('price') }}" class="w-full rounded border border-slate-300">
            </div>
            <div>
                <label class="mb-1 block text-sm font-medium">Stock</label>
                <input type="number" min="0" name="stock" value="{{ old('stock', 0) }}" class="w-full rounded border border-slate-300">
            </div>
        </div>
        <div>
            <label class="mb-1 block text-sm font-medium">Image Path (example: images/watches/classic-silver.svg)</label>
            <input type="text" name="image" value="{{ old('image') }}" class="w-full rounded border border-slate-300">
        </div>
        <div class="flex items-center gap-2">
            <input id="is_featured" type="checkbox" name="is_featured" value="1" @checked(old('is_featured'))>
            <label for="is_featured" class="text-sm">Featured Product</label>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="rounded bg-slate-900 px-5 py-2 font-semibold text-white">Save</button>
            <a href="{{ route('admin.products.index') }}" class="rounded bg-slate-200 px-5 py-2 font-semibold">Cancel</a>
        </div>
    </form>
</x-layouts.store>
