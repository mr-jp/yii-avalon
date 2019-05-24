<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
/* @var $this yii\web\View */

$this->title = 'Avalon Roles';
?>
<div class="site-index">

    <div class="body-content">

        <div class="row">
            <div class="col-lg-12">
                <h2>Game List</h2>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'layout' => '{items}',
                    'columns' => [
                        [
                            'attribute'=>'timestamp',
                            'label' => 'Timestamp',
                            'content'=>function($data){
                                return date("Y-d-m H:i:s", $data->timestamp);
                            }
                        ],
                        [
                            'label' => '',
                            'content' => function($data){
                                return '<a href="#">Join Game</a>';
                            }
                        ],
                        ['class' => 'yii\grid\ActionColumn','template' => '{update} {delete}'],
                    ],
                ]); ?>
            </div>
        </div>

        <?php if(!Yii::$app->user->isGuest): ?>
        <div class="row">
            <div class="col-lg-6">

                <?php $form = ActiveForm::begin(); ?>

                <?php echo $form->field($model, 'timestamp')->hiddenInput(['value'=> time()])->label(false); ?>

                <?php echo $form->field($model, 'started')->hiddenInput(['value'=> 0])->label(false); ?>


                <div class="form-group">
                    <?= Html::submitButton('New Game', ['class' => 'btn btn-success']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <?php endif ?>
    </div>
</div>
