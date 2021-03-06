<?php


namespace App\Service;


use App\Entity\Player;
use Symfony\Component\HttpKernel\KernelInterface;

class ImageManager
{
    private $appKernel;

    public function __construct(KernelInterface $appKernel)
    {
        $this->appKernel = $appKernel;
    }

    public function saveImage(
        Player $player
    ): string {
        $base64 = explode(',', $player->getBase64());
        $ext = $this->getExtension($base64[0]);
        if ($player->getPhotoName() === null || !str_contains($player->getPhotoName(), '.')
        ) {
            $fileName = rand().'-'.$player->getFirstName()
                .'-'.$player->getLastName().$ext;
        } else {
            $fileName = $player->getPhotoName();
        }
        $file = fopen(
            $this->appKernel->getProjectDir().'\public\uploads\\'.$fileName,
            'wb'
        );
        fwrite($file, base64_decode($base64[1]));
        fclose($file);

        return $fileName;
    }

    private function getExtension(string $text): string
    {
        return '.'.explode(';', explode('/', $text)[1])[0];
    }

    public function removeImage(Player $player)
    {
        unlink(
            $this->appKernel->getProjectDir().'\public\uploads\\'
            .$player->getPhotoName()
        );
    }

    public function getBase64(string $fileName): string
    {
        $type = pathinfo(
            $this->appKernel->getProjectDir().'\public\uploads\\'.$fileName,
            PATHINFO_EXTENSION
        );
        $data = file_get_contents($fileName);

        return 'data:image/'.$type.';base64,'.base64_encode($data);
    }
}