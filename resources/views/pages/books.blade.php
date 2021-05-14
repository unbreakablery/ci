<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

use Joki20\Models\Book;

// Book class


?>

<h1>Books</h1>

<?php

$books = Book::all();

?>

<table id="books">
    <thead>
        <tr>
            <th>Title</th>
            <th>ISBN</th>
            <th>Author</th>
            <th>Image</th>
        </tr>
    </thead>
    <tbody>
<?php
foreach ($books as $book) { ?>
        <tr>
            <td><?= $book->title ?></td>
            <td><?= $book->isbn ?></td>
            <td><?= $book->author ?></td>
            <td><img src='<?= $book->image ?>'></td>
<?php }; ?>
    </tbody>
</table>
