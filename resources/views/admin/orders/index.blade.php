<x-layouts.store title="Admin | Orders">
    <h1 class="text-3xl font-bold">Manage Orders</h1>

    <div class="mt-6 rounded-xl bg-white p-5 shadow">
        <table id="orders-table" class="min-w-full text-left text-sm">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Order #</th>
                    <th>User</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Placed At</th>
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
                $('#orders-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('admin.orders.data') }}',
                    columns: [
                        { data: 'id', name: 'id' },
                        { data: 'order_number', name: 'order_number' },
                        { data: 'user_name', name: 'user.name' },
                        { data: 'status', name: 'status' },
                        { data: 'total_amount', name: 'total_amount' },
                        { data: 'placed_at', name: 'placed_at' },
                        { data: 'actions', name: 'actions', orderable: false, searchable: false }
                    ]
                });
            });
        </script>
    @endpush
</x-layouts.store>
