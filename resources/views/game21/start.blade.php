@include('header')

<h1>Welcome to Dice Game</h1>
<h2 class="text-italic">please, play this dice game!</h2>

<h3>Your Points: {{ $yourPoints }}</h3>
<h3>Computer Points: {{ $computerPoints }}</h3>
<h3>Your Wins: {{ $yourWins }}</h3>
<h3>Computer Wins: {{ $computerWins }}</h3>

<p class="btn-wrapper">
    <a href="{{ route('game21-player-roll') }}" class="success-link">Roll, Your turn</a>
    <a href="{{ route('game21-computer-play') }}" class="danger-link">Stop, Computer turn</a>
</p>
@include('footer')