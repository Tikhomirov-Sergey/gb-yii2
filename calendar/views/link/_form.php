<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Event;


/* @var $this yii\web\View */
/* @var $model app\models\Link */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="link-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>

     <?= $form->field($model, 'rel_event_id')->dropDownList(ArrayHelper::map(Event::find()->all(), 'id', 'title')) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
