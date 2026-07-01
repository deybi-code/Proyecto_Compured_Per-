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
            $valido = md5($plain) === $stored;
            if ($valido) {
                $this->rehashALaBcrypt($user, $plain);
            }
            return $valido;
        }

        // SHA1
        if (strlen($stored) === 40 && ctype_xdigit($stored)) {
            $valido = sha1($plain) === $stored;
            if ($valido) {
                $this->rehashALaBcrypt($user, $plain);
            }
            return $valido;
        }

        // Texto plano
        $valido = $plain === $stored;
        if ($valido) {
            $this->rehashALaBcrypt($user, $plain);
        }
        return $valido;
    }

    /**
     * CORREGIDO: las contraseñas MD5/SHA1/texto plano quedaban así para
     * siempre, ya que solo se comparaban pero nunca se actualizaban. Ahora,
     * en cuanto un usuario legado inicia sesión correctamente, su contraseña
     * se re-hashea a Bcrypt de forma transparente, sin pedirle nada. Con el
     * tiempo, todos los usuarios activos terminan en Bcrypt.
     */
    private function rehashALaBcrypt(Authenticatable $user, string $plain): void
    {
        $user->forceFill([
            $user->getAuthPasswordName() => $this->hasher->make($plain),
        ])->save();
    }
}
