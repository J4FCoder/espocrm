<?php
/************************************************************************
 * This file is part of EspoCRM.
 *
 * EspoCRM - Open Source CRM application.
 * Copyright (C) 2014-2020 Yuri Kuznetsov, Taras Machyshyn, Oleksiy Avramenko
 * Website: https://www.espocrm.com
 *
 * EspoCRM is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * EspoCRM is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with EspoCRM. If not, see http://www.gnu.org/licenses/.
 *
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU General Public License version 3.
 *
 * In accordance with Section 7(b) of the GNU General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "EspoCRM" word.
 ************************************************************************/

namespace Espo\Core\Authentication\AuthToken;

use Espo\{
    ORM\EntityManager,
};

use RuntimeException;

class EspoAuthTokenManager implements AuthTokenManager
{
    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getNew() : AuthToken
    {
        $authToken = $this->entityManager
            ->getRepository('AuthToken')
            ->getNew();

        return $authToken;
    }

    public function get(string $token) : ?AuthToken
    {
        $authToken = $this->entityManager
            ->getRepository('AuthToken')
            ->where([
                'token' => $token,
            ])
            ->findOne();

        return $authToken;
    }

    public function getActive(string $token) : ?AuthToken
    {
        $authToken = $this->entityManager
            ->getRepository('AuthToken')
            ->where([
                'token' => $token,
                'isActive' => true,
            ])
            ->findOne();

        return $authToken;
    }

    public function save(AuthToken $authToken)
    {
        $this->validate($authToken);

        $this->entityManager
            ->getRepository('AuthToken')
            ->save($authToken);
    }

    protected function validate(AuthToken $authToken)
    {
        if (!$authToken->getToken()) {
            throw new RuntimeException("Empty token.");
        }

        if (!$authToken->getUserId()) {
            throw new RuntimeException("Empty user ID.");
        }
    }
}
