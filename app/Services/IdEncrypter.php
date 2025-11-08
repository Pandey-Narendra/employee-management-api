<?php

namespace App\Services;

use Illuminate\Support\Facades\Crypt;
use InvalidArgumentException;

class IdEncrypter
{
    protected string $salt;

    public function __construct()
    {
        $this->salt = config('app.id_encryption_salt') ?: env('ID_ENCRYPTION_SALT', '');
        if (empty($this->salt)) {
            // In production, throw error if salt is missing
        }
    }

    /**
     * Encrypt numeric ID → base64 token
     */
    public function encrypt(int|string $id): string
    {
        $raw = $this->salt . '|' . (string) $id;
        $encrypted = Crypt::encryptString($raw);
        return base64_encode($encrypted);
    }

    /**
     * Decrypt base64 token → integer ID
     */
    public function decrypt(string $token): int
    {
        try {
            $decoded = base64_decode($token, true);
            if ($decoded === false) {
                throw new InvalidArgumentException('Invalid ID token format.');
            }

            $decrypted = Crypt::decryptString($decoded);
            $parts = explode('|', $decrypted, 2);

            if (count($parts) !== 2 || $parts[0] !== $this->salt) {
                throw new InvalidArgumentException('Invalid or tampered ID token.');
            }

            $id = (int) $parts[1];
            if ($id <= 0) {
                throw new InvalidArgumentException('Invalid ID value.');
            }

            return $id;
        } catch (\Throwable $e) {
            throw new InvalidArgumentException('Invalid ID token.');
        }
    }
}
