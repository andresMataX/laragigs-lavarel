{{-- Variable que tienen los componentes blade y se la combina con el atributo de clase de HTML --}}
<div {{ $attributes->merge(['class' => 'bg-gray-50 border border-gray-200 rounded p-6']) }}>
    {{-- Para envolver algo dentro del componente --}}
    {{ $slot }}
</div>
