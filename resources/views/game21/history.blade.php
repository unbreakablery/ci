@include('header')

<h1 class="text-success">Game History</h1>

<h3>Total Games: {{ $yourWins + $computerWins }}</h3>
<h3 class="text-success">Your wins: {{ $yourWins }}</h3>
<h3 class="text-info">Computer wins: {{ $computerWins }}</h3>

@foreach ($history as $h)
<p>Winner: {{ $h['winner'] }}, Your Points: {{ $h['your-points'] }}, Computer Points: {{ $h['computer-points'] }}</p>
@endforeach
<p class="btn-wrapper">
    <a href="{{ route('game21') }}" class="success-link">New Game</a>
    <a href="{{ route('game21-clear-history') }}" class="danger-link">Clear History</a>
</p>

@include('footer')