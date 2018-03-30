<?php
/**
 * Created by PhpStorm.
 * User: kello
 * Date: 30/03/2018
 * Time: 15:31
 */

namespace SoukBundle\EventListener;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class RegistrationListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return array(
            FOSUserEvents::REGISTRATION_SUCCESS => 'onRegistrationSuccess',
        );
    }

    public function onRegistrationSuccess(FormEvent $event)
    {
        $rolesArr = array('ROLE_USER');
        /** @var $user \FOS\UserBundle\Model\UserInterface */
        $user = $event->getForm()->getData();
        if($event->getRequest()->get('role')==='ROLE_VENDEUR')
        {
            $rolesArr=array('ROLE_USER','ROLE_VENDEUR');
        }
        $user->setRoles($rolesArr);
    }
}

