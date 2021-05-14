<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

use Joki20\Http\Controllers\Game21\Game21;

?>

<h1>Game 21</h1>

<?php session(['game21' => new Game21()]);

echo session('game21')->game21();

?>
