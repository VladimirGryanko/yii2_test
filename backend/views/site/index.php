<?php

use yii\helpers\Html;
use yii\grid\GridView;
/* @var $this yii\web\View */

$this->title = 'Админка';
?>
<div class="site-index">
    <div class="body-content">
        <div class="row text-center">
            <div class="col-lg-4 justify-content-center text-center ">
                <h2>Книги</h2>

                <p><a class="btn btn-default" href="/backend/web/books/">Перейти</a></p>
            </div>

            <div class="col-lg-4 justify-content-center text-center ">
                <h2>Авторы</h2>

                <p><a class="btn btn-default" href="/backend/web/authors/">Перейти</a></p>
            </div>
            <div class="col-lg-4 justify-content-center text-center">
                <h2>Gii</h2>

                <p><a class="btn btn-default" href="/backend/web/gii/">Перейти</a></p>
            </div>
        </div>

    </div>
</div>