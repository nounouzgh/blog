@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('All Resources') }}</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($resources as $resource)
                                    <tr>
                                        <td>{{ $resource->name }}</td>
                                        <td>{{ $resource->description }}</td>
                                        <td>
                                            <!-- Delete Resource Button -->
                                            <form action="{{ route('resource.destroy', $resource->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                            <!-- Edit Resource Button -->
                                            <a href="{{ route('resource.edit', $resource->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                            <!-- Show Resource Button -->
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
