@include('header')

<h1>Game 21</h1>
<h3>Game Setting</h3>

<form action="{{ route('game21-save-setting') }}" method="post">
    @csrf
    <p>
        <label for="cnt-dices">Number of Dices: </label>
        <select name="cnt-dices" id="cnt-dices">
            @for ($i = 1; $i <= 2; $i++)
            <option value="{{ $i }}" @if ($i == $settings->cnt_dices) {{ 'selected' }} @endif>{{ $i }}</option>
            @endfor
        </select>
    </p>
    <p>
        <label for="dice-type">Dice Type: </label>
        <select name="dice-type" id="dice-type">
            <option value="graphical" selected>Graphical</option>
        </select>
    </p>
    <p>
        <label for="dice-type">Bet Amount: </label>
        <input type="number" class="bet-amount" name="bet-amount" placeholder="Max: 50% of your bitcoins" min="0" max="{{ $settings->coin1 / 2 }}" step="0.01" required /> (Your BTC: {{ $settings->coin1 }})
    </p>
    <p class="btn-wrapper">
        <button type="submit" class="btn-submit">Save</button>
    </p>
</form>

@include('footer')