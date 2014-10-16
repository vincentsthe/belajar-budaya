<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $form = ActiveForm::begin(['id'=>'login-form']); ?>
<?= Html::activeHiddenInput($model,'fb_id',['id'=>'fb-id']); ?>
<?= Html::activeHiddenInput($model,'fb_access_token',['id'=>'fb-access-token']); ?>
<?php ActiveForm::end(); ?>

<center><?= Html::img("@web/img/logo_web.png",[]); ?><br><br><br>
<div id="fb-root"></div>
<?=Html::a(Html::img("@web/img/login_facebook.png"),['site/fblogin'],['id'=>'fblogin']); ?>
</center>

  <script type="text/javascript">
/*
  window.fbAsyncInit = function() {
      FB.init({
        appId      : '701116673300033',
        cookie     : true,  // enable cookies to allow the server to access 
                            // the session
        xfbml      : true,  // parse social plugins on this page
        version    : 'v2.1' // use version 2.1
      });
      //checkLoginState();
    }

  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      if (response.status == 'connected') {
        $("#fb-id").val(response.authResponse.userID);
        $("#fb-access-token").val(response.authResponse.accessToken);
        $("#login-form").submit();
        //console.log($("#fb-id").val());
        //console.log($("#fb-access-token").val());
      }
    });

  }


  
  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
*/
</script>
