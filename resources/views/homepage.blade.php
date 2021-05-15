@include('header')

<h1>Home page</h1>
<p>Welcome to My Game21</p>
<h3>Dice FACES:</h3>
<p>
@foreach ($diceImgs as $diceImg)
    {!! $diceImg !!}
@endforeach
</p>
<p>You can see my code on <a href="https://github.com/beha20/mvc">Github</a></p>

@include('footer')