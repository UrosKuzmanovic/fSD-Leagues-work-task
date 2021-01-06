<?php


namespace App\Utils;


use App\Entity\BaseEntityInterface;
use App\Entity\Game;
use App\Entity\Player;
use Psr\Log\LoggerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class EntityValidator
{
    private $validator;
    private $logger;

    public function __construct(ValidatorInterface $validator, LoggerInterface $logger)
    {
        $this->validator = $validator;
        $this->logger = $logger;
    }

    public function validate(BaseEntityInterface $entity)
    {
        $errors = $this->validator->validate($entity);
        if (count($errors) > 0) {
            $errorMessages = [];
            foreach ($errors as $error) {
                $errorMessages[$error->getPropertyPath()] = $error->getMessage(
                );
                $this->logger->error($error->getMessage());
            }
            if (count($errorMessages) > 0) {

                return false;
            } else {
                $this->logger->error("VRATIO JE GRESKE");
                return $errorMessages;
            }
        }
        if ($entity instanceof Game) {
            if ($entity->getHome()->getClubID() === $entity->getAway()
                    ->getClubID()
            ) {
                return false;
            }
        }
        if ($entity instanceof Player) {
            if (!$entity->getBase64() || $entity->getBase64() === null || $entity->getBase64() === "") {
                $this->logger->error("NE VALJA SLIKA IGRACA");
                return false;
            }
        }

        return true;
    }
}