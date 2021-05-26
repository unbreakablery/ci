@include('header')

<h1 class="text-success">Dice Game was Ended!</h1>

<h2 class="text-italic">{{ $message }}</h2>
<p>Your points: {{ $yourPoints }}</p>
<p>Computer points: {{ $computerPoints }}</p>
<h3 class="text-italic text-info">{{ $highScoreMsg }}</h3>
<hr />
<p>Your Balance: {{ $yourBalance }}</p>
<p>Computer Balance: {{ $computerBalance }}</p>

<h2>Game History</h2>
<p>Your wins: {{ $yourWins }}</p>
<p>Computer wins: {{ $computerWins }}</p>
<p class="btn-wrapper">
    <a href="{{ route('game21') }}" class="success-link">New Game</a>
    <a href="{{ route('game21-view-history') }}" class="info-link">View History</a>
    <a href="{{ route('game21-clear-history') }}" class="danger-link">Clear History</a>
</p>

@include('footer')