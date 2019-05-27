<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $gameModel app\models\Game */
/* @var $playerModel app\models\Player */

$this->title = 'Role Page';
\yii\web\YiiAsset::register($this);

$textMinions = '<span class="text-danger">Minions</span>';
$textServants = '<span class="text-success">Servants</span>';
$textMerlin = '<span class="text-success">Merlin</span>';
$textPercival = '<span class="text-success">Percival</span>';
$textAssassin = '<span class="text-danger">Assassin (Evil)</span>';
$textMordred = '<span class="text-danger">Mordred (Evil)</span>';
$textMorgana = '<span class="text-danger">Morgana (Evil)</span>';
$textOberon = '<span class="text-danger">Oberon (Evil)</span>';

?>
<div class="role-view">
    <h1 class="<?= $playerModel->team == 'servants' ? 'text-success' : 'text-danger' ?>">
        <?= ucfirst($playerModel->name) ?> /
        <?= ucfirst($playerModel->team) ?> /
        <?= ucfirst($playerModel->role) ?>
        (<?= $playerModel->team == 'servants' ? 'Good' : 'Evil' ?>)
    </h1>

    <!-- role descriptions -->
    <?php if ($playerModel->role == 'merlin'): ?>
        <ul>
            <li>You know the identities of all <?= $textMinions ?>!</li>
            <li>You need to convince the servants to vote against the <?= $textMinions ?></li>
            <li>Don't be too obvious, or the <?= $textAssassin ?> will kill you at the end of the game!</li>
        </ul>
        <p>The <?= $textMinions ?> are:</p>
        <ul>
            <?php foreach($minions as $minion): ?>
                <!-- except mordred -->
                <?php if ($minion->role !== 'mordred'): ?>
                    <li><?= $minion->name ?></li>
                <?php endif?>
            <?php endforeach?>
        </ul>
        <?php if ($gameModel->mordred == '1'): ?>
            <p>Be careful, <?= $textMordred ?> is hidden from you!</p>
        <?php endif ?>
    <?php endif ?>

    <?php if ($playerModel->role == 'percival'): ?>
        <ul>
            <li>Your job is to protect <?= $textMerlin ?>!</li>
            <li>Try to cover for <?= $textMerlin ?> by pretending to be him</li>
            <li>Try to get the <?= $textAssassin ?> to kill you instead at the end of the game!</li>
        </ul>
        <?php if ($gameModel->morgana =='0'): ?>
            <p><?= $textMerlin ?> is <?= $merlin->name ?></p>
        <?php else: ?>
            <!-- randomize order of these 2 names -->
            <?php if (rand(0,1) === 0): ?>
                <p><?= $textMerlin ?> is either <?= $merlin->name ?> OR <?= $morgana->name ?></p>
                <?php else: ?>
                <p><?= $textMerlin ?> is either <?= $morgana->name ?> OR <?= $merlin->name ?></p>
            <?php endif ?>
            <p>One of them is <?= $textMorgana ?>, be careful!</p>
        <?php endif?>
    <?php endif ?>

    <?php if ($playerModel->role == 'servant'): ?>
        <ul>
            <li>You need to vote for quests to be sucessful!</li>
            <li>Try to find out who the other <?= $textServants?> are!</li>
            <li>Watch out for <?= $textMinions ?>!</li>
        </ul>
    <?php endif ?>

    <?php if ($playerModel->role == 'assassin'): ?>
        <ul>
            <li>You need to work with the other <?= $textMinions ?></li>
            <li>At the end of the game, try to find out who is <?= $textMerlin ?>!</li>
            <li>If you guess correctly, <?= $textMinions ?> win!</li>
        </ul>
        <p>The other <?= $textMinions ?> are:</p>
        <ul>
            <?php foreach($minions as $minion): ?>
                <!-- except oberon -->
                <?php if (($minion->role !== 'oberon') and ($minion->name !== $playerModel->name)): ?>
                    <li><?= $minion->name ?></li>
                <?php endif?>
            <?php endforeach?>
        </ul>
        <?php if ($gameModel->oberon == '1'): ?>
            <p>However, <?= $textOberon ?> is hidden. Try to find him!</p>
        <?php endif ?>
    <?php endif ?>

    <?php if ($playerModel->role == 'mordred'): ?>
        <ul>
            <li>You need to work with the other <?= $textMinions ?></li>
            <li><?= $textMinions ?> should try to fail quests</li>
            <li>You are unknown to <?= $textMerlin ?></li>
        </ul>
        <p>The other <?= $textMinions ?> are:</p>
        <ul>
            <?php foreach($minions as $minion): ?>
                <!-- except oberon -->
                <?php if (($minion->role !== 'oberon') and ($minion->name !== $playerModel->name)): ?>
                    <li><?= $minion->name ?></li>
                <?php endif?>
            <?php endforeach?>
        </ul>
        <?php if ($gameModel->oberon == '1'): ?>
            <p>However, <?= $textOberon ?> is hidden. Try to find him!</p>
        <?php endif ?>
    <?php endif ?>

    <?php if ($playerModel->role == 'morgana'): ?>
        <ul>
            <li>You need to work with the other <?= $textMinions ?></li>
            <li><?= $textMinions ?> should try to fail quests</li>
            <li>You appear to <?= $textPercival ?> to <?= $textMerlin ?></li>
        </ul>
        <p>The other <?= $textMinions ?> are:</p>
        <ul>
            <?php foreach($minions as $minion): ?>
                <!-- except oberon -->
                <?php if (($minion->role !== 'oberon') and ($minion->name !== $playerModel->name)): ?>
                    <li><?= $minion->name ?></li>
                <?php endif?>
            <?php endforeach?>
        </ul>
        <?php if ($gameModel->oberon == '1'): ?>
            <p>However, <?= $textOberon ?> is hidden. Try to find him!</p>
        <?php endif ?>
    <?php endif ?>

    <?php if ($playerModel->role == 'minion'): ?>
        <ul>
            <li>You need to work with the other <?= $textMinions ?></li>
            <li><?= $textMinions ?> should try to fail quests</li>
        </ul>
        <p>The other <?= $textMinions ?> are:</p>
        <ul>
            <?php foreach($minions as $minion): ?>
                <!-- except oberon -->
                <?php if (($minion->role !== 'oberon') and ($minion->name !== $playerModel->name)): ?>
                    <li><?= $minion->name ?></li>
                <?php endif?>
            <?php endforeach?>
        </ul>
        <?php if ($gameModel->oberon == '1'): ?>
            <p>However, <?= $textOberon ?> is hidden. Try to find him!</p>
        <?php endif ?>
    <?php endif ?>

    <?php if ($playerModel->role == 'oberon'): ?>
        <ul>
            <li>You need to work with the other <?= $textMinions ?></li>
            <li><?= $textMinions ?> should try to fail quests</li>
            <li>However, they do now know you are!</li>
            <li>You also don't know the identity of other <?= $textMinions ?>!</li>
        </ul>
    <?php endif ?>
</div>