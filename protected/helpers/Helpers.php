<?php

class Helpers {
    
    /*
    * Time to seconds
    */
    static public function timeToSec ($time) {
        $hours = substr($time, 0, -6);
        $minutes = substr($time, -5, 2);
        $seconds = substr($time, -2);

        return $hours * 3600 + $minutes * 60 + $seconds;
    }

    /*
    * Seconds to time
    *  25*60*60 -> 25:00:00
    */    
    static function secToTime ($seconds) {
        $hours = floor($seconds / 3600);
        $minutes = floor($seconds % 3600 / 60);
        $seconds = $seconds % 60;
        return sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);
    }
    

    /* A function to take a date in ($date) in specified inbound format (eg mm/dd/yy for 12/08/10) and
     * return date in $outFormat (eg yyyymmdd for 20101208)
     *    datefmt (
     *                        string $date - String containing the literal date that will be modified
     *                        string $inFormat - String containing the format $date is in (eg. mm-dd-yyyy)
     *                        string $outFormat - String containing the desired date output, format the same as date()
     *                    )
     *
     *
     *    ToDo:
     *        - Add some error checking and the sort?
     */    
    static function datefmt($date, $inFormat, $outFormat) {
        $order = array('mon' => NULL, 'day' => NULL, 'year' => NULL);

        for ($i=0; $i<strlen($inFormat);$i++) {
            switch ($inFormat[$i]) {
                case "m":
                    $order['mon'] .= substr($date, $i, 1);
                    break;
                case "d":
                    $order['day'] .= substr($date, $i, 1);
                    break;
                case "y":
                    $order['year'] .= substr($date, $i, 1);
                    break;
            }
        }

        $unixtime = mktime(0, 0, 0, $order['mon'], $order['day'], $order['year']);
        $outDate = date($outFormat, $unixtime);

        if ($outDate == False) {
            return False;
        } else {
            return $outDate;
        }
    }
        
        /**
         * Возвращает расширение файла
         *
         * @param string $filename - Путь с именем файла
         * @return string расширение файла
         */
        static function getExtension($filename) {
                return end(explode(".", $filename));
        }
    
        /**
         * Удаляет 'соль' из ключей массива
         *
         * @param array $data
         * @param string $salt
     * @return void
         */    
    static function removeSalt( &$data, $salt) {
        if (!empty($salt)) {
            foreach($data as $key => $value) {
                $pos = strpos( $key, $salt);
                if ( $pos !== false) {
                    $key_ = substr($key, 0, $pos);
                    $data[$key_] = $value;
                    unset($data[$key]);
                }
            }
        }
    }
    
    /*
     * scandir() with regexp matching on file name and sorting options based on stat().
     * 
     * files can be sorted on name and stat() attributes, ascending and descending:
        name    file name
        dev     device number
        ino     inode number
        mode    inode protection mode
        nlink   number of links
        uid     userid of owner
        gid     groupid of owner
        rdev    device type, if inode device *
        size    size in bytes
        atime   time of last access (Unix timestamp)
        mtime   time of last modification (Unix timestamp)
        ctime   time of last inode change (Unix timestamp)
        blksize blocksize of filesystem IO *
        blocks  number of blocks allocated
     * 
     */
    static function scandir($dir, $exp, $how = 'name', $desc=0) {
        $r = array();
        $dh = @opendir($dir);
        if ($dh) {
            while (($fname = readdir($dh)) !== false) {
                if (preg_match($exp, $fname)) {
                    $stat = stat("$dir/$fname");
                    $r[$fname] = ($how == 'name') ? $fname: $stat[$how];
                }
            }
            closedir($dh);
            if ($desc) {
                arsort($r);
            } else {
                asort($r);
            }
        }
        return(array_keys($r));
    }

    static function imageresize($outfile, $infile, $neww, $newh, $quality = 90, $param = "" ) {
		//ini_set('gd.jpeg_ignore_warning', 1);
		$old_memory_limit = ini_get('memory_limit');
		ini_set('memory_limit', '150M');

		$im=imagecreatefromjpeg($infile);

		$k1=$neww/imagesx($im);
		$k2=$newh/imagesy($im);

		if(is_string($param))
			$param = array($param);

		if( in_array('fix_w', $param) )
		{
			$k = $k1;
		}
		else if( in_array('fix_h', $param) )
		{
			$k = $k2;
		}
		else
		{
			$k=$k1>$k2?$k2:$k1;
		}

		$w=intval(imagesx($im)*$k);
		$h=intval(imagesy($im)*$k);

		$im1=imagecreatetruecolor($w,$h);
		imagecopyresampled($im1,$im,0,0,0,0,$w,$h,imagesx($im),imagesy($im));

		imagejpeg($im1,$outfile,$quality);
		imagedestroy($im);
		imagedestroy($im1);

		ini_set('memory_limit', $old_memory_limit);
	}

    static function deleteDirectory($dir){
        if ($handle = opendir($dir)) {
            $array = array();

            while (false !== ($file = readdir($handle))) {
                if ($file != "." && $file != "..") {

                    if(is_dir($dir.$file))
                    {
                        if(!@rmdir($dir.$file)) // Empty directory? Remove it
                        {
                            self::deleteDirectory($dir.$file.'/'); // Not empty? Delete the files inside it
                        }
                    }
                    else
                    {
                       @unlink($dir.$file);
                    }
                }
            }
            closedir($handle);

            @rmdir($dir);
        }
    }

    static function tempFileName($dir,$prefix){
        $name = $prefix.md5(time().rand());
        $handle = fopen($dir.'/'.$name, "w");
        fclose($handle);

        return $name;
    }

    static function renderImageBlock ($path, $fileName, $photoId){

        $img = CHtml::image( Yii::app()->request->baseUrl . $path . "/thumbs/$fileName", '', array('height' => 104));
        $linkImg = CHtml::link( $img, Yii::app()->request->baseUrl . $path . "/big/$fileName", array());

        $linkDel = CHtml::link( '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', Yii::app()->request->baseUrl . '/photo/delete/id/' . $photoId, array('class' => 'del', 'title' => 'Удалить изображение'));

        $li = CHtml::tag('li', array( 'id' => $photoId, "class" => "g-fleft", "style" => "padding: 5px 5px;"), $linkImg . ' ' . $linkDel);

        return $li;
    }
}