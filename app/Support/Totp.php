<?php

namespace App\Support;

class Totp
{
    // Generate a base32 secret (16 chars ~ 80 bits)
    public static function generateSecret(int $length = 16): string {
        $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
        $s = '';
        for ($i=0; $i<$length; $i++) {
            $s .= $alphabet[random_int(0, strlen($alphabet)-1)];
        }
        return $s;
    }

    public static function otpauthUrl(string $email, string $secret, string $issuer): string {
        $label = rawurlencode($issuer.':'.$email);
        $issuerEnc = rawurlencode($issuer);
        return "otpauth://totp/{$label}?secret={$secret}&issuer={$issuerEnc}&period=30&digits=6&algorithm=SHA1";
    }

    public static function verify(string $secret, string $code, int $window = 1): bool {
        $code = trim($code);
        if (strlen($code) !== 6) return false;
        $time = time();
        for ($w = -$window; $w <= $window; $w++) {
            $t = floor(($time / 30)) + $w;
            if (hash_equals(self::totp($secret, $t), $code)) return true;
        }
        return false;
    }

    public static function totp(string $secret, int $timeSlice): string {
        $key = self::base32Decode($secret);
        $time = pack('N*', 0) . pack('N*', $timeSlice); // 8-byte big-endian
        $hash = hash_hmac('sha1', $time, $key, true);
        $offset = ord(substr($hash, -1)) & 0x0F;
        $truncatedHash = substr($hash, $offset, 4);
        $value = unpack('N', $truncatedHash)[1] & 0x7FFFFFFF;
        $mod = 10 ** 6;
        return str_pad((string)($value % $mod), 6, '0', STR_PAD_LEFT);
    }

    public static function base32Decode(string $s): string {
        $s = strtoupper($s);
        $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
        $flipped = array_flip(str_split($alphabet));
        $buffer = 0;
        $bitsLeft = 0;
        $result = '';
        foreach (str_split($s) as $c) {
            if ($c === '=') break;
            if (!isset($flipped[$c])) continue;
            $buffer = ($buffer << 5) | $flipped[$c];
            $bitsLeft += 5;
            if ($bitsLeft >= 8) {
                $bitsLeft -= 8;
                $result .= chr(($buffer >> $bitsLeft) & 0xFF);
            }
        }
        return $result;
    }
}
