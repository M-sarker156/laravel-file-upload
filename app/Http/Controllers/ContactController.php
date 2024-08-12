<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // Display a listing of the contacts
    public function index(Request $request)
    {
        $sortBy = $request->query('sort_by', 'name');
        $searchTerm = $request->query('search', '');

        $contacts = Contact::where('name', 'like', "%{$searchTerm}%")
            ->orWhere('email', 'like', "%{$searchTerm}%")
            ->orderBy($sortBy)
            ->paginate(10);

        return view('contacts.index', compact('contacts', 'sortBy', 'searchTerm'));
    }

    // Show the form for creating a new contact
    public function create()
    {
        return view('contacts.create');
    }

    // Store a newly created contact in storage
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:contacts,email',
        ]);

        Contact::create($request->all());

        return redirect()->route('contacts.index')->with('success', 'Contact created successfully.');
    }

    // Display the specified contact
    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return view('contacts.show', compact('contact'));
    }

    // Show the form for editing the specified contact
    public function edit($id)
    {
        $contact = Contact::findOrFail($id);
        return view('contacts.edit', compact('contact'));
    }

    // Update the specified contact in storage
    public function update(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:contacts,email,' . $contact->id,
        ]);

        $contact->update($request->all());

        return redirect()->route('contacts.index')->with('success', 'Contact updated successfully.');
    }

    // Remove the specified contact from storage
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->route('contacts.index')->with('success', 'Contact deleted successfully.');
    }
}
