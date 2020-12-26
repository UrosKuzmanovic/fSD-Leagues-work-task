<?php


namespace App\Utils;


use App\Entity\BaseEntityInterface;
use App\Entity\Place;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class EntityValidator
{
    private $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function validate(BaseEntityInterface $entity){
        $errors = $this->validator->validate($entity);
        if (count($errors) > 0){
            $errorMessages = [];
            foreach ($errors as $error){
                $errorMessages[$error->getPropertyPath()] = $error->getMessage();
            }
            if (count($errorMessages) > 0){
                return false;
            } else {
                return $errorMessages;
            }
        }
        return true;
    }
}