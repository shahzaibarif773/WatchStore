<x-layouts.store title="Admin | Order Items">
    <h1 class="text-3xl font-bold">Manage Order Items</h1>

    <div class="mt-6 rounded-xl bg-white p-5 shadow">
        <table id="order-items-table" class="min-w-full text-left text-sm">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Order #</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Subtotal</th>
                    <th>Created</th>
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
                $('#order-items-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('admin.order-items.data') }}',
                    columns: [
                        { data: 'id', name: 'id' },
                        { data: 'order_number', name: 'order.order_number' },
                        { data: 'product_name', name: 'product.name' },
                        { data: 'quantity', name: 'quantity' },
                        { data: 'unit_price', name: 'unit_price' },
                        { data: 'subtotal', name: 'subtotal' },
                        { data: 'created_at', name: 'created_at' }
                    ]
                });
            });
        </script>
    @endpush
</x-layouts.store>
