FFMPEG
======
convert media from one format to other

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist elisevgeniy/yii2-ffmpeg "*"
```

or add

```
"elisevgeniy/yii2-ffmpeg": "*"
```

to the require section of your `composer.json` file.

Configuration
---------------
Install ffmpeg in your system if not installed.
To use this extension, you have to configure the Connection class in your application configuration:

return [
    //....
    'components' => [
        'ffmpeg' => ['class' => '\rbtphp\ffmpeg\Ffmpeg',
					'path' => '/usr/bin/ffmpeg'
		],
    ]
];


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
$args = array('type' => 'audio/video/image', 
			'input_file' => '/home/user/Pictures/movie.mp4', 
			'output_file' => '/home/user/Pictures/movie.mov', 
			'audio_bit_rate' => '20k', 
			'video_bit_rate' => '10k', 
			'thumbnail_image' => '/home/user/Pictures/movie.gif',
			'thumbnail_generation' => 'yes/no',
			'thumbnail_size' => '100x100'
		);
			
echo Yii::$app->ffmpeg->ffmpeg($args);```
