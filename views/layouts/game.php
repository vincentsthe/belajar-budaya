<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap" ng-controller="SiteController" ng-init="init()">
        <?php
            NavBar::begin([
                'brandLabel' => Html::img("@web/img/header.png"),
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-default navbar-static-top-header',
                    'id' => 'header'
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right','style' => 'padding: 5px 0px 5px 0px;'],
                'items' => [
                    ['label' => '<i class="fa fa-home"></i> Home', 'url' => ['/site/home']],
                    ['label' => '<i class="fa fa-plus"></i> Add Item', 'url' => ['/site/additem']],
                    Yii::$app->user->isGuest ?
                        ['label' => 'Login', 'url' => ['/site/login']] :
                        ['label' => 'Logout ({{activeUser.name}})',
                            'url' => ['/site/logout'],
                            'linkOptions' => ['data-method' => 'post']],
                ],
                'encodeLabels' => false,
            ]);
            NavBar::end();
        ?>

        <div>
            <?= $content ?>
        </div>
    </div>

<?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>
