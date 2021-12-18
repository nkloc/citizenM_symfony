<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\Hotel;
use App\Entity\User;

class HotelVoter extends Voter
{
    const HOTEL_EDIT = 'hotel_edit';    
    const HOTEL_DELETE = 'hotel_delete';    
    protected function supports(string $attribute, $hotel): bool
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, [self::HOTEL_EDIT, self::HOTEL_DELETE])
            && $hotel instanceof \App\Entity\Hotel;
    }

    protected function voteOnAttribute(string $attribute, $hotel, TokenInterface $token): bool
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        if(null === $hotel->getUsers()) {
            return false;
        }

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case self::HOTEL_EDIT:
                // logic to determine if the user can EDIT
                // return true or false
                $this->canEdit($hotel, $user);

                break;
            case self::HOTEL_DELETE:
                // logic to determine if the user can VIEW
                // return true or false
                $this->canDelete($hotel, $user);
                break;
        }

        return false;
    }
    private function canEdit(Hotel $hotel, User $user)
    {
        return $hotel->getUsers() === $user;
    }

    private function canDelete(Hotel $hotel, User $user)
    {
        return $hotel->getUsers() === $user;
    }
}
