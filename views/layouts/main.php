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
    <link rel="icon" type="image/x-icon" href="<?=Yii::$app->request->baseUrl?>/img/favicon.ico" />
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
                        ['label' => "Logout(".Yii::$app->user->identity->full_name.")",
                            'url' => ['/site/logout'],
                            'linkOptions' => ['data-method' => 'post']],
                ],
                'encodeLabels' => false,
            ]);
            NavBar::end();
        ?>

        <div class="container">
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; Belajar budaya</p>
            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>
