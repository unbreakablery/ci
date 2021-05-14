<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

use Joki20\Models\Highscore;

// Book class

?>

<h1>Yatzy Highscore</h1>

<?php

$highscores = Highscore::all();

$scoreDesc = $highscores->sortByDesc('score');




?>

<table id="books">
    <thead>
        <tr>
            <th>Highscore list</th>
        </tr>
    </thead>
    <tbody>
<?php

foreach ($scoreDesc as $row) { ?>
    <tr>
        <td><?= $row->score ?></td>
    </tr>
<?php }; ?>
    </tbody>
</table>
