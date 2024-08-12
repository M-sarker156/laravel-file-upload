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
<h1>Contact Details</h1>

<p>Name: {{ $contact->name }}</p>
<p>Email: {{ $contact->email }}</p>
<p>Phone: {{ $contact->phone }}</p>
<p>Address: {{ $contact->address }}</p>

<a href="{{ route('contacts.edit', $contact->id) }}">Edit</a>

<form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit">Delete</button>
</form>

<a href="{{ route('contacts.index') }}">Back to Contacts</a>
@endsection

</body>
</html>