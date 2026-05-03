<x-layouts.store title="Admin | Message #{{ $message->id }}">
    <div class="flex flex-wrap items-start justify-between gap-4">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.35em] text-slate-500">Support message</p>
            <h1 class="mt-2 text-3xl font-bold text-slate-950">{{ $message->subject }}</h1>
            <p class="mt-2 text-sm text-slate-600">Received {{ $message->created_at->format('Y-m-d H:i') }}</p>
        </div>
        <a href="{{ route('admin.contact-messages.index') }}" class="rounded bg-slate-200 px-4 py-2 font-semibold text-slate-900 transition hover:bg-slate-300">Back to list</a>
    </div>

    <div class="mt-8 grid gap-6 lg:grid-cols-[1fr_1.2fr]">
        <div class="rounded-xl bg-white p-6 shadow">
            <h2 class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">Sender</h2>
            <dl class="mt-4 space-y-3 text-sm">
                <div>
                    <dt class="font-semibold text-slate-700">Name</dt>
                    <dd class="mt-1 text-slate-900">{{ $message->name }}</dd>
                </div>
                <div>
                    <dt class="font-semibold text-slate-700">Email</dt>
                    <dd class="mt-1"><a href="mailto:{{ $message->email }}" class="text-amber-700 underline hover:text-amber-900">{{ $message->email }}</a></dd>
                </div>
                <div>
                    <dt class="font-semibold text-slate-700">Store account</dt>
                    <dd class="mt-1 text-slate-900">
                        @if ($message->user)
                            {{ $message->user->name }} ({{ $message->user->email }})
                        @else
                            Guest (not logged in)
                        @endif
                    </dd>
                </div>
            </dl>
        </div>

        <div class="rounded-xl bg-white p-6 shadow">
            <h2 class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">Message</h2>
            <div class="mt-4 whitespace-pre-wrap text-sm leading-relaxed text-slate-800">{{ $message->message }}</div>
        </div>
    </div>
</x-layouts.store>
