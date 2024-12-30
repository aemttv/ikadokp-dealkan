<table>
    @isset($properti)
        <p>Data found: {{ count($properti) }} items</p>
        @foreach ($properti as $data)
            <p>{{ $data->title ?? 'Title not found' }}</p>
        @endforeach
    @else
        <p>No data found</p>
    @endisset


</table>
