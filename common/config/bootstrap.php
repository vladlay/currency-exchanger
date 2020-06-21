<?php
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');
// Yii::setAlias('@uploads', dirname(dirname(__DIR__)) . '/frontend/web/uploads');
// /home/wlawallay/projects/diploma.net/frontend/web/uploads/btc.png
Yii::setAlias('@uploads', 'http://diploma.net/uploads');