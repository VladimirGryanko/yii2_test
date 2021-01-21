<?php

use yii\grid\GridView;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="body-content">

        <div class="row">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    'title',
                    ['attribute' => 'authorName', 'value' => 'authors.name'],
                    'genre',
                ],
            ]); ?>
        </div>
    </div>
</div>