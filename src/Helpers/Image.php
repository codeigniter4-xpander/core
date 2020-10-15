<?php namespace CI4Xpander\Helpers;

class Image
{
    public static function saveImageFromBase64($source = '', $target = '')
    {
        $base64Decoder = new \Melihovv\Base64ImageDecoder\Base64ImageDecoder($source, [
            'jpg', 'jpeg', 'png'
        ]);

        $fileName = "{$target}.{$base64Decoder->getFormat()}";

        file_put_contents($fileName, $base64Decoder->getDecodedContent());

        return $fileName;
    }

    public static function getBase64($path = '')
    {
        $base64Encoder = \Melihovv\Base64ImageDecoder\Base64ImageEncoder::fromFileName($path, [
            'jpg', 'jpeg', 'png'
        ]);

        return $base64Encoder->getDataUri();
    }
}