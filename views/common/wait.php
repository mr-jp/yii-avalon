<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Game */

$this->title = 'Wait Page';
\yii\web\YiiAsset::register($this);
?>
<div class="wait-view">

    <h2>Waiting for other players ...</h2>

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->errorSummary($model); ?>
    <?php if (Yii::$app->user->isGuest): ?>
        <p>Click here when Admin has started the game:</p>
        <div class="form-group">
            <?= Html::submitButton('Join Game', ['class' => 'btn btn-success']) ?>
        </div>
    <?php else: ?>
        <p>When all other players have joined, click here:</p>
        <div class="form-group">
            <?= Html::submitButton('Start Game', ['class' => 'btn btn-success']) ?>
        </div>
    <?php endif ?>
    <?php ActiveForm::end(); ?>

</div>
