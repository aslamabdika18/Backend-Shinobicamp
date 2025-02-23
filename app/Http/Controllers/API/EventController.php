<?php

namespace App\Http\Controllers\API;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controllers\Middleware;



class EventController extends Controller
{

    public function index()
    {
        $events = Event::with(['categoryCamp', 'classCamp'])
            ->latest()
            ->paginate(10);

        return EventResource::collection($events);
    }

    public function show(Event $event)
    {
        return new EventResource($event->load(['categoryCamp', 'classCamp']));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'first_event_date' => 'required|date',
            'last_event_date' => 'required|date|after_or_equal:first_event_date',
            'register_deadline' => 'required|date|before:first_event_date',
            'is_active' => 'boolean',
            'poster' => 'required|file|mimes:jpg,jpeg,png|max:2048',
            'proposal' => 'required|file|mimes:pdf,doc,docx|max:5120',
        ], [
            'poster.required' => 'Poster harus diunggah',
            'poster.mimes' => 'Poster harus berformat jpg, jpeg, atau png',
            'poster.max' => 'Ukuran poster maksimal 2MB',
            'proposal.required' => 'Proposal harus diunggah',
            'proposal.mimes' => 'Proposal harus berformat pdf, doc, atau docx',
            'proposal.max' => 'Ukuran proposal maksimal 5MB',
            'last_event_date.after_or_equal' => 'Tanggal akhir event harus setelah atau sama dengan tanggal mulai event',
            'register_deadline.before' => 'Deadline pendaftaran harus sebelum tanggal mulai event'
        ]);

        if ($request->hasFile('poster')) {
            $posterPath = $request->file('poster')->store('posters', 'public');
            $validated['poster'] = $posterPath;
        }

        if ($request->hasFile('proposal')) {
            $proposalPath = $request->file('proposal')->store('proposals', 'public');
            $validated['proposal'] = $proposalPath;
        }

        $event = Event::create($validated);

        return new EventResource($event->load(['categoryCamp', 'classCamp']));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'location' => 'sometimes|required|string|max:255',
            'first_event_date' => 'sometimes|required|date',
            'last_event_date' => 'sometimes|required|date|after_or_equal:first_event_date',
            'register_deadline' => 'sometimes|required|date|before:first_event_date',
            'is_active' => 'sometimes|boolean',
            'poster' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'proposal' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        if ($request->hasFile('poster')) {
            if ($event->poster) {
                Storage::disk('public')->delete($event->poster);
            }
            $posterPath = $request->file('poster')->store('posters', 'public');
            $validated['poster'] = $posterPath;
        }

        if ($request->hasFile('proposal')) {
            if ($event->proposal) {
                Storage::disk('public')->delete($event->proposal);
            }
            $proposalPath = $request->file('proposal')->store('proposals', 'public');
            $validated['proposal'] = $proposalPath;
        }

        $event->update($validated);

        return new EventResource($event->load(['categoryCamp', 'classCamp']));
    }

    public function destroy(Event $event)
    {
        if ($event->poster) {
            Storage::disk('public')->delete($event->poster);
        }
        if ($event->proposal) {
            Storage::disk('public')->delete($event->proposal);
        }

        $event->delete();

        return response()->noContent();
    }
}
