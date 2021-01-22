<?php

namespace backend\modules\api\modules\v1\controllers;

use Yii;
use common\models\Books;
use yii\rest\ActiveController;
use yii\filters\ContentNegotiator;
use yii\helpers\ArrayHelper;
use yii\web\Response;
use yii\web\NotFoundHttpException;
use yii\filters\Cors;

class BookController extends ActiveController
{
  public $modelClass = 'common\models\Books';
  // public function actionList($id)
  // {
  //   return Book::findOne($id);
  // }
  public function behaviors()
  {
    $behaviors = parent::behaviors();
    $behaviors['contentNegotiator'] = [
      'class' => ContentNegotiator::className(),
      'formats' => [
        'application/json' => Response::FORMAT_JSON,
        'charset' => 'UTF-8',
      ],
    ];
    $behaviors['corsFilter'] = [
      'class' => Cors::className(),
    ];
    return $behaviors;
  }
  public function actionList()
  {
    $books = Books::find()->joinWith('authors', '`id_authors` = `id`')->asArray()->select('name,title')->all();
    $book = ArrayHelper::map($books, 'title', 'name');
    return $book;
  }

  public function actionUpdate($id)
  {
    $book = $this->findBook($id);
    if ($book->load(Yii::$app->request->post()) && $book->save()) {
      return [
        'success' => true,
        'message' => "Book was updated!",
      ];
    }
    return [
      'success' => false,
      'message' => $book->errors,
    ];
  }

  public function actionId($id)
  {
    $book = $this->findBook($id);
    if ($book->delete()) {
      return [
        'success' => true,
        'message' => "Book was deleted!",
      ];
    }
    return [
      'success' => false,
      'message' => $book->errors,
    ];
  }

  public function actionById($id)
  {
    if (($model = Books::find()->where(['id' => $id])->with('authors')->one()) !== null) {
      return $model;
    } else {
      throw new NotFoundHttpException('The requested page does not exist.');
    }
  }
}
