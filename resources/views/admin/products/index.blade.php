<x-layouts.store title="Admin | Products">
    <div class="flex items-center justify-between">
        <h1 class="text-3xl font-bold">Manage Products</h1>
        <a href="{{ route('admin.products.create') }}" class="rounded bg-emerald-600 px-4 py-2 text-sm font-semibold text-white">Add Product</a>
    </div>

    <div class="mt-6 rounded-xl bg-white p-5 shadow">
        <table id="products-table" class="min-w-full text-left text-sm">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Featured</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
    </div>

    @push('styles')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
    @endpush

    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
        <script>
            $(function () {
                $('#products-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('admin.products.data') }}',
                    columns: [
                        { data: 'id', name: 'id' },
                        { data: 'name', name: 'name' },
                        { data: 'price', name: 'price' },
                        { data: 'stock', name: 'stock' },
                        { data: 'is_featured', name: 'is_featured' },
                        { data: 'created_at', name: 'created_at' },
                        { data: 'actions', name: 'actions', orderable: false, searchable: false }
                    ]
                });
            });
        </script>
    @endpush
</x-layouts.store>
