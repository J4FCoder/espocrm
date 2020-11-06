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

/**
 * An auth token record.
 */
interface AuthToken
{
    /**
     * Get a token.
     */
    public function getToken() : string;

    /**
     * Get a user ID.
     */
    public function getUserId() : string;

    /**
     * Get a portal ID. If a token belongs to a specific portal.
     */
    public function getPortalId() : ?string;

    /**
     * Get a token secret. Secret is used as an additional security check.
     */
    public function getSecret() : ?string;

    /**
     * Whether a token is active.
     */
    public function isActive() : bool;

    /**
     * Get a password hash. If a password hash is not stored in token, then returns NULL.
     * If you store auth tokens remotely it's reasonable to avoid hashes being sent for a security reason.
     */
    public function getHash() : ?string;

    /**
     * Get an IP address associated with a token.
     */
    public function getIpAddress() : ?string;

    /**
     * Get a last access date-time.
     */
    public function getLastAccess() : ?string;

    /**
     * Set a token inactive.
     */
    public function setInactive();

    /**
     * Set a token. Supposed that it's generated.
     */
    public function setToken(string $token);

    /**
     * Set a user ID.
     */
    public function setUserId(string $userId);

    /**
     * Set a portal ID. A token can be associated with a specific portal.
     */
    public function setPortalId(string $portalId);

    /**
     * Set a password hash. Supposed that it's generated. Can be skipped in implementation.
     */
    public function setSecret(string $secret);

    /**
     * Set a password hash. Can be skipped in implementation.
     * If you store auth tokens remotely it's reasonable to avoid hashes being sent for a security reason.
     * If you don't store hashes, then you will need to use a custom login implementation instead of
     * a default `Espo\Core\Authentication\Login\Espo`.
     */
    public function setHash(string $hash);

    /**
     * Set an IP address.
     */
    public function setIpAddress(string $ipAddress);

    /**
     * Set a last access date-time. Can be skipped in implementation.
     */
    public function setLastAccess(string $lastAccess);
}