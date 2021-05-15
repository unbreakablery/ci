@include('header')

<h1 class="text-success">High Scores</h1>

<table class="highscores">
    <thead>
        <tr>
            <th class="text-primary">Rank</th>
            <th class="text-primary">Date</th>
            <th class="text-primary">Player</th>
            <th class="text-primary">Score</th>
        </tr>
    </thead>
    <tbody>
        @if (count($highScores) > 0)
            @foreach ($highScores as $idx => $highScore)
                <tr>
                    <td class="text-center">{{ $idx + 1 }}</td>
                    <td class="text-center">{{ $highScore->date }}</td>
                    <td class="text-center">{{ $highScore->player }}</td>
                    <td class="text-right">{{ $highScore->score }}</td>
                </tr>
            @endforeach
        @else
            <tr>
                <td class="text-italic text-danger text-center" colspan="4">No High Scores !</td>
            </tr>
        @endif
    </tbody>
</table>

<p class="btn-wrapper">
    <a href="{{ route('game21') }}" class="success-link">New Game</a>
    <a href="{{ route('game21-clear-highscores') }}" class="danger-link">Clear HighScores</a>
</p>

@include('footer')