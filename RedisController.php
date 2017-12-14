<?php

namespace app\controllers;
use Yii;
use yii\web\Controller;
use yii\redis\Connection;
use app\models\Users;
class RedisController extends Controller
{
    //关闭csrf验证，使获取到from的数据
    public $enableCsrfValidation=false;
    //获取mysql的数据传到redis上
    public function actionIndex(){
                $this->layout = false;                    
        $redis=Yii::$app->redis;
                $student=Users::find()->all();
        foreach ($student as $key => $v) {
            $redis->incr('userid');
            $redis->hmset('user:'.$v['id'],'id',$v['id'],'username',$v['username'],'sex',$v['sex'],'idcate',$v['idcate'],'dorm_id',$v['dorm_id'],'iclass',$v['iclass'],'adress',$v['adress'],'nation',$v['nation'],'major',$v['major'],'birthday',$v['birthday'],'photo',$v['photo'],'famname',$v['famname'],'hujiadress',$v['hujiadress'],'stutel',$v['stutel'],'weixin',$v['weixin'],'qq',$v['qq'],'email',$v['email'],'famtel',$v['famtel'],'pro',$v['pro'],'city',$v['city'],'area',$v['area'],'rili',$v['rili'],'bed',$v['bed'],'openid',$v['openid'],'status',$v['status']);
            $redis->rpush('uid',$v['id']);
        }
        echo "<pre>";
        print_r($student);
    }
    //分页查出数据显示在首页
    public function actionRedis(){
        $this->layout = false;                    
        $redis=Yii::$app->redis;
        $pagesize=10;
        $counts=$redis->get('userid');
        $page=Yii::$app->request->get('page')?Yii::$app->request->get('page'):1;
        $ids=$redis->lrange('uid',$pagesize*($page-1),$pagesize*$page-1);
        foreach($ids as $tt){
            $ulist[]=$redis->hgetall('user:'.$tt);
        }
        return $this->render('index',['ulist'=>$ulist,'page'=>$page]);

    }
    //删
    public function actionDeluser()
    {
        $id=Yii::$app->request->get('id');
        $redis=Yii::$app->redis;
        $redis->del('user:'.$id);
        $redis->lrem('uid',1,$id);
        $redis->decr('userid');

    }
    //增加页面
    public function actionZengjia()
    {
        $this->layout = false;
    return $this->render('new'); 
    }
    //修改页面
    public function actionXiugai(){
        $this->layout = false;
        $id=Yii::$app->request->get('id');
         $redis=Yii::$app->redis;
         // $counts=$redis->get($id);
         $info=$redis->hgetall('user:'.$id);
         // echo "<pre>";
         // print_r($info);exit;
         return $this->render('xiugai',['x'=>$info]); 
      
    }
    //处理增加方法
    public function actionDo_insert(){
       $this->layout = false;
       $redis=Yii::$app->redis;
        $data=Yii::$app->request->post();
        $count=$redis->get('userid')+1;
        $redis->incr('userid');

        $add=$redis->hmset('user:'.$count,'id',$count,
                                'username',$data['username'],
                                'sex',$data['sex'],
                                'idcate',$data['idcate']
                                //'dorm_id',$data['dorm_id'],
                                //'iclass',$data['iclass'],
                                //'adress',$data['adress'],
                                //'nation',$data['nation']
                                //'stutel',$data['stutel'],
                                //'birthday',$data['birthday']
                                );
         $redis->rpush('uid',$count);
         if($add){
            echo "succ";
           return $this->render('new');
         }else{
            echo "fail";
         }
        
     }
    //处理修改方法
    public function actionDo_up()
    {
       $this->layout = false;
       $redis=Yii::$app->redis;
        $data=Yii::$app->request->post();
       $id=$data['id']+1;

// echo "<pre>";
// print_r($count);exit;
        $add=$redis->hmset('user:'.$id,
                                'id',$id,
                                'username',$data['username'],
                                'sex',$data['sex'],
                                'idcate',$data['idcate']
                                //'dorm_id',$data['dorm_id'],
                                //'iclass',$data['iclass'],
                                //'adress',$data['adress'],
                                //'nation',$data['nation']
                                //'stutel',$data['stutel'],
                                //'birthday',$data['birthday']
                                );

         if($add){
            echo "succ";
           return $this->render('new');
         }else{
            echo "fail";
         }
        
    }
}
?>




