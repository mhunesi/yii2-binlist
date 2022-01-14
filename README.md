Yii2 Binlist (Turkey Banks)
============
Yii2 Binlist Model

Bin listesi garanti bankasından ve diğer bankalardan alınan bilgiler ile birleştirilmiştir.

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist mhunesi/yii2-binlist "*"
```

or add

```
"mhunesi/yii2-binlist": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
$model = Binlist::find()->bin('489458');

if($model && $model->isCreditCard()){
    echo "Taksit yapılabilir.";
}


```