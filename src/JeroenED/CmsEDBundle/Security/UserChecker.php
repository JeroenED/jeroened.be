<?php
namespace JeroenED\CmsEDBundle\Security;

use JeroenED\CmsEDBundle\Entity\User as AppUser;
use Symfony\Component\Security\Core\Exception\AccountExpiredException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\AccountStatusException;

class UserChecker implements UserCheckerInterface
{
    public function checkPreAuth(UserInterface $user)
    {
        if (!$user instanceof AppUser) {
            return;
        }

        // user is deleted, show a generic Account Not Found message.
        if (!$user->getIsActive()) {
            throw new AccountExpiredException('Account is deactivated');
        }
    }

    public function checkPostAuth(UserInterface $user)
    {

    }
}