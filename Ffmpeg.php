<?php

namespace rbtphp\ffmpeg;

use Yii;
/**
 * This is just an example.
 */
class Ffmpeg
{
	public $path;
	
    public function ffmpeg($args = array())
    {
		$ffmpeg = Yii::$app->ffmpeg->path;
		$video_bit_rate = '';
		$audio_bit_rate = '';
		$thumb_nail_size = '';
		$type = ! empty( $args['type'] ) ? $args['type'] : '';
		$input_file = ! empty( $args['input_file'] ) ? $args['input_file'] : '';
		$target_file = ! empty( $args['output_file'] ) ? $args['output_file'] : '';
		$audio_bitrate = ! empty( $args['audio_bit_rate'] ) ? $args['audio_bit_rate'] : '';
		$video_bitrate = ! empty( $args['video_bit_rate'] ) ? $args['video_bit_rate'] : '';
		$thumbnail_image = ! empty( $args['thumbnail_image'] ) ? $args['thumbnail_image'] : '';
		$thumbnail_size = ! empty( $args['thumbnail_size'] ) ? $args['thumbnail_size'] : '';
		$thumbnail_generation = ! empty( $args['thumbnail_generation'] ) ? $args['thumbnail_generation'] : '';
		//echo '<pre>';print_r($args);exit;
		if ($video_bitrate != '') {
			$video_bit_rate = '-b:v '.$video_bitrate;
		}
		if ($audio_bitrate != '') {
			$audio_bit_rate = '-b:a '.$audio_bitrate;
		}
		if ($thumbnail_size != '' && $type == 'video') {
			$thumb_nail_size = '-s '.$thumbnail_size;
		}
		if ($thumbnail_size != '' && $type == 'image') {
			$thumb_nail_size = $thumbnail_size;
		}
		if ($type != '') {
			if ($type == 'video' && $target_file != '') {
				$cmd = "$ffmpeg -y -i $input_file -c:v libx264 $video_bit_rate $audio_bit_rate -strict -2 $target_file";
				exec($cmd,$results);
			} else if ($type == 'audio' && $target_file != '') {
				$cmd = "$ffmpeg -y -i $input_file $audio_bit_rate $target_file";
				exec($cmd,$results);
			} else if ($type == 'image' && $target_file != '') {
				$cmd = "$ffmpeg -y -i $input_file -f image2 $target_file";
				exec($cmd,$results);
			}
			//thumbnail
			if ($thumbnail_generation == 'yes') {
				if ($type == 'video' || $type == 'image') {
					if ($thumbnail_size != '') {
						if ($type == 'video') {
							$cmd2 = "$ffmpeg -y -i $input_file -t 1 $thumb_nail_size -f image2 $thumbnail_image";
							exec($cmd2,$results);
						}
						if ($type == 'image') {
							$cmd2 = "$ffmpeg -y -i $input_file -vf scale=".$thumb_nail_size." $thumbnail_image";
							exec($cmd2,$results);
						}
					} elseif ($thumbnail_size == '') {
                        if ($type == 'video') {
                            $cmd2 = "$ffmpeg -y -i $input_file -t 1 -f image2 $thumbnail_image";
                            exec($cmd2,$results);
                        }
                    }
				}
			}
			return true;
		} else {
			echo 'Please check parameters you provided. Try again';exit;
		}
		
    }
}
