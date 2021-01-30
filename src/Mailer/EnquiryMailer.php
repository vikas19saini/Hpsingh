<?php

namespace App\Mailer;

use Cake\Mailer\Mailer;

/**
 * Enquiry mailer.
 */
class EnquiryMailer extends Mailer {

    /**
     * Mailer's name.
     *
     * @var string
     */
    static public $name = 'Enquiry';

    public function contact($entity) {
        $email = $this
                ->setTo(\Cake\Core\Configure::read('Store.email'))
                ->setSubject(\Cake\Core\Configure::read('Store.name') . ': received new inquiry')
                ->setTemplate('inquiry/contact')
                ->setLayout('inquiry')
                ->setEmailFormat('html')
                ->setFrom($entity->email, \Cake\Core\Configure::read('Store.name'))
                ->set(['entity' => $entity]);
        
        if(!empty($entity->reference)){
            $email->setAttachments(WWW_ROOT . 'files' . DS . 'Enquiries' . DS . 'reference' . DS . $entity->reference);
        }
        
    }

}
