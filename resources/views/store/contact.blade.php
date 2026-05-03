<x-layouts.store title="WatchStore | Contact">
    <section class="overflow-hidden store-panel">
        <div class="grid gap-0 lg:grid-cols-[0.92fr_1.08fr]">
            <div class="bg-slate-950 px-6 py-8 text-white sm:px-8 sm:py-10">
                <span class="store-badge border-white/10 bg-white/10 text-amber-200">Concierge</span>
                <h1 class="mt-4 text-5xl font-semibold text-amber-50 font-display">Contact us</h1>
                <p class="mt-4 max-w-md text-sm leading-7 text-slate-300 sm:text-base">Send us your questions about watches, orders, support, or anything else related to the store.</p>

                <div class="mt-8 space-y-4 text-sm text-slate-300">
                    <div class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3">You’ll get an email at <span class="font-semibold text-amber-200">{{ config('mail.contact_to_address') }}</span> and the message is saved for your admin inbox.</div>
                    <div class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3">Built for the Laravel 11 class project</div>
                    <div class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3">Response window: same day on weekdays</div>
                </div>
            </div>

            <div class="px-6 py-8 sm:px-8 sm:py-10">
                <form method="POST" action="{{ route('contact.store') }}" class="space-y-4">
                    @csrf
                    <div class="grid gap-4 md:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">Your name</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 shadow-sm outline-none transition focus:border-amber-300 focus:ring-2 focus:ring-amber-200">
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">Your email</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 shadow-sm outline-none transition focus:border-amber-300 focus:ring-2 focus:ring-amber-200">
                        </div>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">Subject</label>
                        <input type="text" name="subject" value="{{ old('subject') }}" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 shadow-sm outline-none transition focus:border-amber-300 focus:ring-2 focus:ring-amber-200">
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">Message</label>
                        <textarea name="message" rows="7" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 shadow-sm outline-none transition focus:border-amber-300 focus:ring-2 focus:ring-amber-200">{{ old('message') }}</textarea>
                    </div>

                    <button type="submit" class="store-button-primary w-full">Send message</button>
                </form>
            </div>
        </div>
    </section>
</x-layouts.store>
