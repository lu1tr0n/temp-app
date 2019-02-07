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
use app\assets\AppAsset;

AppAsset::register($this);
$this->beginPage();
?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="/img/favicon.png">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="stylesheet" href="/css/login.css">
</head>
<body>
    <!-- Message Begin -->
    <div class="myAlert-top alert alert-success">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success!</strong> Indicates a successful or positive action.
    </div>
    <div class="myAlert-bottom alert alert-danger" style="text-align:center;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Incorrect!</strong> Field Not Blank.
    </div>
    <!-- END -->
    <?php $this->beginBody() ?>
    
    <!-- Message -->

    <form id="formLogin" action="<?php //echo Url::to(['login'], true); ?>" method="POST" class="form-signin">
        <div class="text-center mb-4">
            <img class="mb-4" src="/img/login.svg" alt="" width="72" height="72">
            <h1 class="h3 mb-3 font-weight-normal">Log in</h1>
        </div>

        <div class="form-label-group">
            <input type="text" id="inputEmail" name="inputEmail" class="form-control" placeholder="Username" required autofocus>
            <label for="inputEmail">Username</label>
        </div>

        <div class="form-label-group">
            <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required>
            <label for="inputPassword">Password</label>
        </div>

        <div class="checkbox mb-3">
            <label>
            <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <button id="btnSubmit" class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        <p class="mt-5 mb-3 text-muted text-center">&copy; 2017-2018</p>
    </form>

    <?php $this->endBody() ?>
    <script src="/js/script.js" type="text/javascript"></script>
</body>
</html>
<?php $this->endPage() ?>