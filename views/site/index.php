<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
/* @var $this yii\web\View */

$this->title = 'Avalon Roles';
?>
<div class="site-index">

    <div class="body-content">

        <div class="row">
            <div class="col-lg-12">
                <h1>Avalon Role Generator</h1>
                <!-- Game is open (waiting for players) -->
                <!-- Game is running (or no open game) -->
                <?php if ($gameAvailable === false): ?>
                    <div class="alert alert-danger" role="alert">No open game at the moment!</div>
                    <?php else: ?>
                        <h2>Current Game: <?= date("Ydm - H:i", $gameModel->timestamp) ?></h2>
                        <p>Number of players: <?= $playerCount ?> / <?= $gameModel->players ?></p>

                        Special Characters:
                        <ul>
                            <?php if($gameModel->percival == '1'): ?>
                                <li>Percival</li>
                            <?php endif ?>
                            <?php if($gameModel->mordred == '1'): ?>
                                <li>Mordred</li>
                            <?php endif ?>
                            <?php if($gameModel->morgana == '1'): ?>
                                <li>Morgana</li>
                            <?php endif ?>
                            <?php if($gameModel->oberon == '1'): ?>
                                <li>Oberon</li>
                            <?php endif ?>
                        </ul>


                        <?php $form = ActiveForm::begin(); ?>
                        <?= $form->field($playerModel, 'name')->textInput(['maxlength' => true]) ?>
                        <?php echo $form->field($playerModel, 'fk_game_id')->hiddenInput(['value'=> $gameModel->id])->label(false); ?>
                        <div class="form-group">
                            <?= Html::submitButton('Join Game', ['class' => 'btn btn-success']) ?>
                        </div>
                        <?php ActiveForm::end(); ?>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>
