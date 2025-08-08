
@extends('layouts.dashboard')

@section('title', 'Loads Dashboard')
@section('page-title', 'Loads Dashboard')

@section('content')
<div class="container-fluid">
    <h1>Load Details</h1>
    <a href="{{ route('loads.index') }}" class="btn btn-secondary mb-3">Back to List</a>
    <table class="table table-bordered">
        <tbody>
            @foreach($load->getAttributes() as $key => $value)
                <tr>
                    <th>{{ ucfirst(str_replace('_', ' ', $key)) }}</th>
                    <td>{{ $value }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('loads.edit', $load) }}" class="btn btn-warning">Edit</a>
    <form action="{{ route('loads.destroy', $load) }}" method="POST" style="display:inline-block;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
    </form>
</div>
@endsection
