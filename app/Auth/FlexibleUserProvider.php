<?php

namespace App\Auth;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\Authenticatable;

/**
 * FlexibleUserProvider
 * Permite autenticar usuarios cuyas contraseñas estén en:
 *   - Bcrypt ($2y$...)
 *   - MD5 (32 hex)
 *   - SHA1 (40 hex)
 *   - Texto plano (legado)
 */
class FlexibleUserProvider extends EloquentUserProvider
{
    public function validateCredentials(Authenticatable $user, array $credentials): bool
    {
        $plain  = $credentials['password'];
        $stored = $user->getAuthPassword();

        // Bcrypt
        if (str_starts_with($stored, '$2y$') || str_starts_with($stored, '$2a$')) {
            return $this->hasher->check($plain, $stored);
        }

        // MD5
        if (strlen($stored) === 32 && ctype_xdigit($stored)) {
            return md5($plain) === $stored;
        }

        // SHA1
        if (strlen($stored) === 40 && ctype_xdigit($stored)) {
            return sha1($plain) === $stored;
        }

        // Texto plano
        return $plain === $stored;
    }
}
