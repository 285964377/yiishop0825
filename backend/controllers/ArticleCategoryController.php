<?php

namespace backend\controllers;
use backend\models\Article_category;
use backend\models\ArticleCategory;
use yii\web\Controller;
use yii\web\Request;

class ArticleCategoryController extends Controller {

   //列表展示
 public function actionIndex(){
    $Article=ArticleCategory::find()->all();
    return $this->render('index',['Article'=>$Article]);
   }
    //添加
 public function actionAdd(){
    //实例化
    $model = new ArticleCategory();
    $request = new Request();
    if($request->isPost){
     //加载
    $model->load($request->post());
     //验证
    if($model->validate()){
     //保存
    $model->save();
     //提示信息
    \Yii::$app->session->setFlash('success','添加成功了');
    //提示之后则跳转到首页
    return $this->redirect(['index']);
    }else{//如果出错则打印出错误信息;
    var_dump($model->getErrors());
    }
     }
    return $this->render('add',['modle'=>$model]);
   }
 public function actionEdit($id){
    //实例化
    $model=ArticleCategory::findOne(['id'=>$id]);
    $request= new Request();
    if($request->isPost){
    //加载
    $model->load($request->post());
     //验证
    if($model->validate()){
     //保存
    $model->save();
    //提示信息
    \Yii::$app->session->setFlash('success','添加成功了');
     //提示之后则跳转到首页
    return $this->redirect(['index']);
     }else{//如果出错则打印出错误信息;
     var_dump($model->getErrors());
     }
     }
    return $this->render('edit',['modle'=>$model]);
   }
     //删除功能
 public function actionDelete($id){
     //页面点击之后数据调用到这里之后则修改其状态值为-1代表删除
     $Atricle= ArticleCategory::findOne(['id'=>$id]);
     $Atricle::updateAll(['status'=>-1],['id'=>$id]);
   }
}

