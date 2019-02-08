<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

?>

<div class="container">
  <div class="row">
    <div class="col"></div>
    <div class="col-6">
        <form id="frm-profile" action="<?php echo Url::to(['site/updateprofile'], true); ?>" method="POST">
            <div class="input-group mb-3">
            <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">Name</span>
                </div>
                <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" value="<?php echo $data['name'] ?>">
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">Username</span>
                </div>
                <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" value="<?php echo $data['username']; ?>">
            </div> 

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">Password</span>
                </div>
                <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
            </div>         

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">Email</span>
                </div>
                <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" value="<?php echo $data['email']; ?>">
            </div>

            <div class="input-group m3">
                <button type="submit" class="btn btn-primary">Update profile</button> 
            </div>    
        </form>
    </div>
    <div class="col"></div>
  </div>
</div>