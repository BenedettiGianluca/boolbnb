@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('admin.apartments.create') }}"><button type="button" class="btn btn-success">aggiungi</button></a>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Main Image</th>
                <th scope="col">Host Name</th>
                <th scope="col">Slug</th>
                <th scope="col">Rooms</th>
                <th scope="col">Beds</th>
                <th scope="col">Bathrooms</th>
                <th scope="col">Square meters</th>
                <th scope="col">Address</th>
                <th scope="col">Buttons</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($apartments as $apartment)
                @if ($apartment->visible)
                    <tr>
                        <th scope="row">{{ $apartment->id }}</td>
                        <td>{{ $apartment->name }}</td>
                        @foreach ($images as $image)
                            @if ($image->main_image && $image->apartment_id == $apartment->id)
                            <td class="w-100">
                                <img src="{{$image->url}}" class="w-100">
                            </td>
                                
                            @endif
                        @endforeach
                        <td>
                            @foreach ($users as $host)
                                @if ($host->id == $apartment->user_id)
                                    {{ $host->name }} {{ $host->lastname }}
                                @endif                             
                            @endforeach
                        </td>
                        <td>{{ $apartment->slug }}</td>
                        <td>{{ $apartment->rooms }}</td>
                        <td>{{ $apartment->beds }}</td>
                        <td>{{ $apartment->bathrooms }}</td>
                        <td>{{ $apartment->square_meters }}</td>
                        <td>{{ $apartment->address }}</td>
                        <td>
                            <a href="{{ route('admin.apartments.show', $apartment->id) }}"><button type="button"
                                    class="btn btn-primary">vedi</button></a>
                            <a href="{{ route('admin.apartments.edit', $apartment->id) }}"><button type="button"
                                    class="btn btn-warning">edit</button></a>
                            <form action="{{ route('admin.apartments.destroy', $apartment->id) }}" method="POST">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-danger">delete</button>
                            </form>
                        </td>
                    </tr>
                @endif
            @endforeach

        </tbody>
    </table>
</div>
@endsection