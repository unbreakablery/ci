@include('header')

<h1>Dice Hand!!!</h1>
<h2 class="text-italic">You got points: {{ $points }}</h2>
<p>
    @foreach ($diceImgs as $img)
    {!! $img !!}
    @endforeach
</p>
<h2>{{ $message }}</h2>

<h3>Your Points: {{ $yourPoints }}</h3>
<h3>Computer Points: {{ $computerPoints }}</h3>

@if (!$gameEnded)
<p class="btn-wrapper">
    <a href="{{ route('game21-player-roll') }}" class="success-link">Roll, Your turn</a>
    <a href="{{ route('game21-computer-play') }}" class="danger-link">Stop, Computer turn</a>
</p>
@else
<p class="btn-wrapper">
    <a href="{{ route('game21-view-result') }}" class="info-link">View Result</a>
</p>
@endif

@include('footer')