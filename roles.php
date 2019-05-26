<?php
$players = [
    'Adam',
    'Bob',
    'Charlie',
    'David',
    'Elliot',
    'Frank',
    'Gary',
    'Hector',
    'Ian',
    'Jarod'
];
$assignedPlayers = [];
$minionRules = [
    5 => 2,
    6 => 2,
    7 => 3,
    8 => 3,
    9 => 3,
    10 => 4
];
$enablePercival = false;
$enableMordred = false;
$enableMorgana = false;
$enableOberon = false;

// randomize player order
shuffle($players);

// assign the minions
$minions = [];
$numberOfPlayers = sizeof($players);
$numberOfMinions = $minionRules[$numberOfPlayers];
for($i = 0; $i < $numberOfMinions; $i++) {
    $minions[] = array_pop($players);
}

// assign the servants (remaining players are servants)
$servants = $players;

// do a check to make sure special characters don't outnumber the minion
$specialMinionCount = 0;
if ($enableMordred) $specialMinionCount++;
if ($enableMorgana) $specialMinionCount++;
if ($enableOberon) $specialMinionCount++;
if ($specialMinionCount > $numberOfMinions) {
    throw new \Exception('Number of special characters out number minion count!');
}

// assign assassin
$assignedPlayers[] = [
    'name' => array_pop($minions),
    'team' => 'minions',
    'role' => 'assassin'
];

if ($enableMordred) {
    $assignedPlayers[] = [
        'name' => array_pop($minions),
        'team' => 'minions',
        'role' => 'mordred'
    ];
}

if ($enableMorgana) {
    $assignedPlayers[] = [
        'name' => array_pop($minions),
        'team' => 'minions',
        'role' => 'morgana'
    ];
}

if ($enableOberon) {
    $assignedPlayers[] = [
        'name' => array_pop($minions),
        'team' => 'minions',
        'role' => 'oberon'
    ];
}

// assign remaining minions
for ($i = 0; $i < sizeof($minions); $i++) {
    $assignedPlayers[] = [
        'name' => $minions[$i],
        'team' => 'minions',
        'role' => 'minion'
    ];
}

// assign merlin
$assignedPlayers[] = [
    'name' => array_pop($servants),
    'team' => 'servants',
    'role' => 'merlin'
];

if ($enablePercival) {
    $assignedPlayers[] = [
        'name' => array_pop($servants),
        'team' => 'servants',
        'role' => 'percival'
    ];
}

// assign remaining servants
for ($i = 0; $i < sizeof($servants); $i++) {
    $assignedPlayers[] = [
        'name' => $servants[$i],
        'team' => 'servants',
        'role' => 'servant'
    ];
}

var_dump($assignedPlayers);exit;

?>
