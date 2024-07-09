<?php

namespace App\repositories;

use App\Models\Contact;

class ContactRepository extends AbstractEntityRepository
{
    public function __construct(Contact $contact)
    {
        $this->entity = $contact;
        $this->searchFields = [
            'id',
            'first_name',
            'last_name',
            'telephone',
            'address',
        ];
    }
}
