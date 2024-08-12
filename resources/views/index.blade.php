<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @extends('layouts.app')

@section('content')
<h1>Contacts</h1>

<form method="GET" action="{{ route('contacts.index') }}">
    <input type="text" name="search" placeholder="Search by name or email" value="{{ $searchTerm }}">
    <button type="submit">Search</button>
</form>

<table>
    <thead>
        <tr>
            <th><a href="{{ route('contacts.index', ['sort_by' => 'name']) }}">Name</a></th>
            <th><a href="{{ route('contacts.index', ['sort_by' => 'created_at']) }}">Created At</a></th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($contacts as $contact)
        <tr>
            <td>{{ $contact->name }}</td>
            <td>{{ $contact->created_at }}</td>
            <td>{{ $contact->email }}</td>
            <td>{{ $contact->phone }}</td>
            <td>{{ $contact->address }}</td>
            <td>
                <a href="{{ route('contacts.show', $contact->id) }}">View</a>
                <a href="{{ route('contacts.edit', $contact->id) }}">Edit</a>
                <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $contacts->links() }}

@endsection

</body>
</html>