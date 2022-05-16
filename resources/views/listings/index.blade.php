{{-- @extends('layout')

@section('content') --}}
<x-layout>

    @include('partials._hero')
    @include('partials._search')

    <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">

        @unless(count($listings) == 0)
            @foreach ($listings as $listing)
                {{-- Accedemos a un componente y pasamos un prop --}}
                <x-listing-card :listing="$listing" />
            @endforeach
        @else
            <p>No hay listings</p>
        @endunless

    </div>

    <div class="mt-6 p-4">
        {{ $listings->links() }}
    </div>

</x-layout>

{{-- @endsection --}}

{{-- <h1><?php echo $heading; ?></h1>
<?php foreach ($listings as $listing) : ?>

    <h2><?php echo $listing['title']; ?></h2>
    <p><?php echo $listing['description']; ?></p>

<?php endforeach; ?> --}}
