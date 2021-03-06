<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use kartik\sidenav\SideNav;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'My Company',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'About', 'url' => ['/site/about']],
            ['label' => 'Contact', 'url' => ['/site/contact']],
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <div class="row">
            <div class="col-md-3 col-sm-12">
                <?
                echo SideNav::widget([
                    'type' => SideNav::TYPE_DEFAULT,
                    'heading' => Yii::t('app', 'Side Menu'),
                    'items' => [
                        [
                            'url' => Url::toRoute('site/index'),
                            'label' => Yii::t('app', 'Home'),
                            'active'=>(\Yii::$app->controller->id == 'site'),
                            'icon' => 'home'
                        ],
                        [
                            'url' => '#',
                            'label' => Yii::t('app', 'Tour'),
                            'active'=>(\Yii::$app->controller->id == 'tour'),
                            'items' => [
                                ['label' => Yii::t('app', 'List'), 'url'=> Url::toRoute('tour/index'), 'active' => \Yii::$app->controller->id == 'tour' && \Yii::$app->controller->action->id == 'index'],
                                ['label' => Yii::t('app', 'Create'), 'url'=> Url::toRoute('tour/create'), 'active' => \Yii::$app->controller->id == 'tour' && \Yii::$app->controller->action->id == 'create'],
                            ],
                        ],
                        [
                            'url' => '#',
                            'label' => Yii::t('app', 'Tour Fields'),
                            'active'=>(\Yii::$app->controller->id == 'tour-fields'),
                            'items' => [
                                ['label' => Yii::t('app', 'List'), 'url'=> Url::toRoute('tour-fields/index'), 'active' => \Yii::$app->controller->id == 'tour-fields' && \Yii::$app->controller->action->id == 'index'],
                                ['label' => Yii::t('app', 'Create'), 'url'=> Url::toRoute('tour-fields/create'), 'active' => \Yii::$app->controller->id == 'tour-fields' && \Yii::$app->controller->action->id == 'create'],
                            ],
                        ],
                    ],
                ]);
                ?>
            </div>
            <div class="col-md-9 col-sm-12">
                <?= $content ?>
            </div>
        </div>

    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
