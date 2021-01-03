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
        if (!str_contains($player->getPhotoName(), '.')
        ) {
            $fileName = rand().'-'.$player->getFirstName()
                .'-'.$player->getLastName().$ext;
        } else {
            $fileName = $player->getPhotoName();
        }
        $file = fopen($filepath.$fileName, 'wb');
        fwrite($file, base64_decode($base64[1]));
        fclose($file);

        return $fileName;
    }

    private function getExtension(string $text): string
    {
        return '.'.explode(';', explode('/', $text)[1])[0];
    }

    public function getBase64(string $path): string
    {
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);

        return 'data:image/'.$type.';base64,'.base64_encode($data);
    }
}