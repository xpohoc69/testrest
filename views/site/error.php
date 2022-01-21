<?php

/* @var yii\web\View $this */
/* @var string $name */
/* @var string $message */
/* @var string $code */
/* @var Exception $exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    <h1>(<?= $code; ?>) <?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>
</div>
