<?php

namespace App\Security\Voter;

use App\Entity\User;
use App\Entity\MiPost;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class MiPostVoter extends Voter
{
    public function __construct(
        private Security $security
    ) {
    }

    protected function supports(string $attribute, mixed $subject): bool
    {
        return in_array($attribute, [MiPost::EDIT, MiPost::VIEW])
            && $subject instanceof MiPost;
    }

    protected function voteOnAttribute(
        string $attribute,
        $subject,
        TokenInterface $token
    ): bool {
        /** @var User|null $user */
        $user = $token->getUser();
        
        $isAuth = $user instanceof UserInterface;

        // Admin can do everything (check this first)
        if ($isAuth && $this->security->isGranted('ROLE_ADMIN')) {
            return true;
        }

        switch ($attribute) {
            case MiPost::EDIT:
                return $this->canEdit($subject, $user, $isAuth);
            case MiPost::VIEW:
                if (!$subject->isExtraPrivacy()) {
                    return true;
                }

                return $isAuth &&
                    ($subject->getAuthor()->getId() === $user->getId()
                        || $subject->getAuthor()->getFollows()->contains($user)
                    );
        }

        return false;
    }

    private function canEdit(MiPost $post, ?User $user, bool $isAuth): bool
    {
        if (!$isAuth) {
            return false;
        }

        $isAuthor = $post->getAuthor() && 
                   $user && 
                   $post->getAuthor()->getId() === $user->getId();

        return $isAuthor || $this->security->isGranted('ROLE_EDITOR');
    }

    private function canView(MiPost $post, ?User $user, bool $isAuth): bool
    {

        return true;

    }
}