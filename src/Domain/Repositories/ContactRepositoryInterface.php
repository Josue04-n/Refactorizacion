<?php

declare(strict_types=1);

namespace Lenovo\ProyectoRefactorizacion\Domain\Repositories;

use Lenovo\ProyectoRefactorizacion\Domain\Entities\Contact;

interface ContactRepositoryInterface
{
    public function save(Contact $contact): bool;
}