<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ContactMessageController extends Controller
{
    public function index(): View
    {
        return view('admin.contact-messages.index');
    }

    public function data(): JsonResponse
    {
        $query = ContactMessage::query()->with('user')->latest();

        return DataTables::eloquent($query)
            ->editColumn('subject', fn (ContactMessage $message): string => e(Str::limit($message->subject, 48)))
            ->editColumn('created_at', fn (ContactMessage $message): string => $message->created_at->format('Y-m-d H:i'))
            ->addColumn('account', fn (ContactMessage $message): string => $message->user
                ? e($message->user->email)
                : 'Guest')
            ->addColumn('actions', function (ContactMessage $message): string {
                $showUrl = route('admin.contact-messages.show', $message);

                return '<a href="' . $showUrl . '" class="rounded bg-slate-900 px-2 py-1 text-xs text-white">View</a>';
            })
            ->rawColumns(['actions'])
            ->toJson();
    }

    public function show(ContactMessage $contact_message): View
    {
        $contact_message->load('user');

        return view('admin.contact-messages.show', ['message' => $contact_message]);
    }
}
