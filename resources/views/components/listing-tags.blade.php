@props(['tagsCvs'])

@php
// Dividimos la cadena de la BD según la coma para obtener tres etiquetas
$tags = explode(', ', $tagsCvs);
@endphp

<ul class="flex">
    @foreach ($tags as $tag)
        <li class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs">
            <a href="/?tag={{ $tag }}">{{ $tag }}</a>
        </li>
    @endforeach
</ul>
