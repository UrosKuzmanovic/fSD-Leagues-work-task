<?php


namespace App\Service;


use App\Entity\Player;

class ImageManager
{
    public function saveImage(
        string $filepath,
        Player $player
    ) {
        $base64 = explode(',', $player->getBase64());
        $ext = $this->getExtension($base64[0]);
        $fileName = rand().'-'.$player->getFirstName()
            .'-'.$player->getLastName().$ext;
        $file = fopen($filepath.$fileName, 'wb');
        fwrite($file, base64_decode($base64[1]));
        fclose($file);

        return $fileName;
    }

    private function getExtension(string $text): string
    {
        return '.'.explode(';', explode('/', $text)[1])[0];
    }
}