<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
        <script src="<?php echo BASE_URL; ?>assets/js/jquery.js"></script>
        <script src="<?php echo BASE_URL; ?>assets/js/script.js"></script>

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>

    <body>



        <div id="header">
            <div class="header-content">
                <?php if (isset($this->breadcrumbs)): ?>
                    <?php
                    $this->widget('zii.widgets.CBreadcrumbs', array(
                        'links' => $this->breadcrumbs,
                    ));
                    ?><!-- breadcrumbs -->
                <?php endif ?>
                <div class="header-search">
                    <form action="<?php echo Yii::app()->createUrl('search'); ?>" method="get">
                        <input type="test" name="q" placeholder="search"> 
                    </form>
                </div>
            </div>

        </div><!-- header -->

        <?php echo $content; ?>

        <div class="clear"></div>

        <div id="footer">
            &copy; GitHub Browser<br>
            <a class="foot-email" href="mailto:rebrov.artyom@gmail.com">
                rebrov.artyom@gmail.com
            </a>
        </div><!-- footer -->
    </body>
</html>
