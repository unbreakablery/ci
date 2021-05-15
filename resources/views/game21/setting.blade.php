@include('header')

<h1>Game 21</h1>
<h3>Game Setting</h3>

<form action="{{ route('game21-save-setting') }}" method="post">
    @csrf
    <p>
        <label for="cnt-dices">Number of Dices: </label>
        <select name="cnt-dices" id="cnt-dices">
            <option value="1">1</option>
            <option value="2" selected>2</option>
        </select>
    </p>
    <p>
        <label for="dice-type">Dice Type: </label>
        <select name="dice-type" id="dice-type">
            <option value="graphical" selected>Graphical</option>
        </select>
    </p>
    <p class="btn-wrapper">
        <button type="submit" class="btn-submit">Save</button>
    </p>
</form>

@include('footer')