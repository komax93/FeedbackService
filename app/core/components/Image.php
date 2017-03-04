<?php

class Image
{
    public static function save($file)
    {
        if($file == null)
        {
            return "NULL";
        }

        $imgDir = ROOT . '/public/imageStorage';
        @mkdir($imgDir, 0777);

        $tmp = $file['tmp_name'];
        if(is_uploaded_file($tmp))
        {
            $imageInfo = getimagesize($tmp);

            if(preg_match('{image/(.*)}is', $imageInfo['mime'], $type))
            {
                $fileHash = md5($tmp . time());
                $fullFileName = "{$fileHash}.{$type[1]}";
                $destination = "{$imgDir}/{$fileHash}.{$type[1]}";


                self::imageProcessing($tmp, $imageInfo, $destination);
                return $fullFileName;
            }
            else
            {
                return false;
            }
        }
        
        return false;
    }

    private static function imageProcessing($currentImage, $info, $src)
    {
        $currentWidth = $info[0];
        $currentHeight = $info[1];

        $validImageType = array(
            'image/jpeg' => 'jpeg',
            'image/png' => 'png',
            'image/gif' => 'gif',
        );

        $currentType = $validImageType[$info['mime']];
        $from = call_user_func('imagecreatefrom' . $currentType, $currentImage);

        if($currentWidth > 320 || $currentHeight > 240)
        {
            list($newWidth, $newHeight) = self::imageResize($currentWidth, $currentHeight);
            $to = imagecreatetruecolor($newWidth, $newHeight);
            imagecopyresampled($to, $from, 0, 0, 0, 0, $newWidth, $newHeight, $currentWidth, $currentHeight);

            call_user_func("image" . ucfirst($currentType), $to, $src);
        }
        else
        {
            call_user_func("image" . ucfirst($currentType), $from, $src);
        }
    }

    private static function imageResize($width, $height)
    {
        if($width > 320)
        {
            $newWidth = 320;
            $newHeight = ceil($newWidth / ($width / $height));

            if($newHeight > 240)
            {
                $newHeight = 240;
                $newWidth = ceil($newHeight / ($height / $width));
            }
        }

        if($height > 240)
        {
            $newHeight = 240;
            $newWidth = ceil($newHeight / ($height / $width));

            if($newWidth > 320)
            {
                $newWidth = 320;
                $newHeight = ceil($newWidth / ($width / $height));
            }
        }

        return array($newWidth, $newHeight);
    }
}