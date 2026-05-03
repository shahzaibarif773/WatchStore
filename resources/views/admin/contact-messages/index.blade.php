<x-layouts.store title="Admin | Support messages">
    <h1 class="text-3xl font-bold">Support messages</h1>
    <p class="mt-2 max-w-2xl text-sm text-slate-600">Messages submitted from the storefront contact form. Guests and signed-in customers can reach you here.</p>

    <div class="mt-6 rounded-xl bg-white p-5 shadow">
        <table id="contact-messages-table" class="min-w-full text-left text-sm">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Account</th>
                    <th>Subject</th>
                    <th>Received</th>
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
                $('#contact-messages-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('admin.contact-messages.data') }}',
                    order: [[0, 'desc']],
                    columns: [
                        { data: 'id', name: 'id' },
                        { data: 'name', name: 'name' },
                        { data: 'email', name: 'email' },
                        { data: 'account', name: 'user.email', orderable: false, searchable: false },
                        { data: 'subject', name: 'subject' },
                        { data: 'created_at', name: 'created_at' },
                        { data: 'actions', name: 'actions', orderable: false, searchable: false }
                    ]
                });
            });
        </script>
    @endpush
</x-layouts.store>
