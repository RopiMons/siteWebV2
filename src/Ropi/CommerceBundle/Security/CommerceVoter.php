<?php
/**
 * Created by PhpStorm.
 * User: laurent
 * Date: 2/06/16
 * Time: 22:42
 */

namespace Ropi\CommerceBundle\Security;


use Ropi\CommerceBundle\Entity\Commerce;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class CommerceVoter extends Voter
{

    const EDIT = 'edit';

    /**
     * Determines if the attribute and subject are supported by this voter.
     *
     * @param string $attribute An attribute
     * @param mixed $subject The subject to secure, e.g. an object the user wants to access or any other PHP type
     *
     * @return bool True if the attribute and subject are supported, false otherwise
     */
    protected function supports($attribute, $subject)
    {
        if (!in_array($attribute, array(self::EDIT))) {
            return false;
        }

        // only vote on Post objects inside this voter
        if (!$subject instanceof Commerce) {
            return false;
        }

        return true;
    }

    /**
     * Perform a single access check operation on a given attribute, subject and token.
     *
     * @param string $attribute
     * @param mixed $subject
     * @param TokenInterface $token
     *
     * @return bool
     */
    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        if(in_array('ROLE_ADMIN',$token->getRoles())){
            return true;
        }

        switch ($attribute){
            case self::EDIT: return $this->update($subject,$token);
            default: return false;
        }
    }

    private function update($subject, TokenInterface $token){
        return $token->getUser()->getPersonne()->getCommerces()->contains($subject);
    }
}