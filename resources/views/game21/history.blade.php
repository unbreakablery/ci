@include('header')

<h1 class="text-success">Game History</h1>
<hr />
<h3>Total Games: {{ $yourWins + $computerWins }}</h3>
<h3 class="text-success">Your wins: {{ $yourWins }}</h3>
<h3 class="text-info">Computer wins: {{ $computerWins }}</h3>
<hr />
<h3 class="text-success">Your Balance: {{ $yourBalance }}</h3>
<h3 class="text-info">Computer Balance: {{ $computerBalance }}</h3>

<table class="history">
    <thead>
        <tr>
            <th class="text-primary">#</th>
            <th class="text-primary">Date</th>
            <th class="text-primary">Winner</th>
            <th class="text-primary">Your Points</th>
            <th class="text-primary">Computer Points</th>
            <th class="text-primary">Bet Amount</th>
        </tr>
    </thead>
    <tbody>
        @if (count($history) > 0)
            @foreach ($history as $idx => $h)
                <tr>
                    <td class="text-center">{{ $idx + 1 }}</td>
                    <td class="text-center">{{ $h->date }}</td>
                    <td class="text-center">{{ $h->winner }}</td>
                    <td class="text-right">{{ $h->point1 }}</td>
                    <td class="text-right">{{ $h->point2 }}</td>
                    <td class="text-right">{{ $h->bet_amount }}</td>
                </tr>
            @endforeach
        @else
            <tr>
                <td class="text-italic text-danger text-center" colspan="6">No History !</td>
            </tr>
        @endif
    </tbody>
</table>

<p class="btn-wrapper">
    <a href="{{ route('game21') }}" class="success-link">New Game</a>
    <a href="{{ route('game21-clear-history') }}" class="danger-link">Clear History</a>
</p>

@include('footer')