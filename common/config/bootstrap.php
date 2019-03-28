<?php
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@bkend', dirname(dirname(__DIR__)) . '/backend/controllers');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');

# Dev Alias Set-up
// Yii::setAlias('@mFrontend', 'http://ams.front.local');
// Yii::setAlias('@mBackend', 'nackend/backend/web');
Yii::setAlias('@mBackend', 'http://localhost/ams-mis/backend/web');
// Yii::setAlias('@mBackend', dirname(dirname(__DIR__)) . '/backend/web/');
Yii::setAlias('@bkImages', dirname(dirname(__DIR__)) . '/backend/web/');
Yii::setAlias('@fImages', dirname(dirname(__DIR__)) . '/frontend/web/');
?>
