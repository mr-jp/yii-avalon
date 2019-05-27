<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Game */

$this->title = $model->id;
\yii\web\YiiAsset::register($this);
?>
<div class="wait-view">

    <h2>Waiting for other players ...</h2>

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->errorSummary($model); ?>
    <p>When all other players have joined, click here:</p>
    <div class="form-group">
        <?= Html::submitButton('Start Game', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
