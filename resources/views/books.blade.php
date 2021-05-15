@include('header')

<table class="books">
    <thead>
        <tr>
            <th class="text-primary"></th>
            <th class="text-primary">ISBN</th>
            <th class="text-primary">Title</th>
            <th class="text-primary">Author</th>
            <th class="text-primary">Image</th>
        </tr>
    </thead>
    <tbody>
        @if (count($books) > 0)
            @foreach ($books as $book)
                <tr>
                    <td class="text-center">{{ $book->id }}</td>
                    <td class="text-center text-success">{{ $book->isbn }}</td>
                    <td class="text-center">{{ $book->title }}</td>
                    <td class="text-left">{{ $book->author }}</td>
                    <td class="text-center"><img src="{{ asset('/images/books/' . $book->image_url) }}" /></td>
                </tr>
            @endforeach
        @else
            <tr>
                <td class="text-danger" colspan="5">No books !</td>
            </tr>
        @endif
    </tbody>
</table>

@include('footer')
