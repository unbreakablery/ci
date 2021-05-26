@include('header')

<h1 class="text-success">Game21 Help</h1>
<ul>
    <li>
        <p>
            You can choose whether you want to play with one or two dice(s).
        </p>
    </li>
    <li>
        <p>
            You will play with graphical dices animating.
        </p>
    </li>
    <li>
        <p>
            You roll the dice and get a result. 
            Then you can throw again to get more points. 
            You should get as close to 21 as possible.
        </p>
    </li>
    <li>
        <p>
            When the player is satisfied, it can "stop".
        </p>
    </li>
    <li>
        <p>
            If the player gets 21, note a big "Congratulations!".
        </p>
        <p>
            If the player gets over 21, then he has lost.
        </p>
    </li>
    <li>
        <p>
            Then it's the computer's turn. 
            The computer wins by an equal points.
        </p>
        <p>
            If the computer gets over 21, you won this round.
        </p>
    </li>
    <li>
        <p>
            As a pure premium, you can bet "bitcoins" in each game round. 
            The player can start with 10 bitcoins and 
            you can bet a maximum of 50% of your bitcoins per game. 
            The computer can have 100 bitcoins when you start.
        </p>
        <p>
            The bet amount will be selected the amount less than between the player and computer.
        </p>
        <p class="text-info text-italic">
            <strong>Thanks for your injoing my game!</strong>
        </p>
    </li>
</ul>

@include('footer')
