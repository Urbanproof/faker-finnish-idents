<?php

namespace Urbanproof\FakerIdents;

use BadMethodCallException;
use DateTime as NativeDateTime;
use Faker\Provider\Base;
use Faker\Provider\DateTime;

class IdentProvider extends Base
{
    /**
     * Generate random national identity number
     *
     * @return string
     */
    public static function personIdent(?NativeDateTime $date = null, ?string $gender = null): string
    {
        do {
            $birthdate = $date ?? DateTime::dateTime();
            // born before 1.1.2000 => dash, born after 1.1.2000 => A
            $separator = $birthdate->getTimestamp() < 946684800 ? '-' : 'A';
            $birthdate = $birthdate->format('dmy');
            $serial = mt_rand(2, 999); // serial distinguishes persons born in the same day
            if (
                ($gender === GENER_MALE && $serial % 2 !== 1) || // male serials must be odd
                ($gender === GENER_FEMALE && $serial % 2 !== 0) // female serails must be even
            ) {
                $serial++;
            }
            $serial = str_pad($serial, 3, '0', STR_PAD_LEFT); // ensure three-digit serial
            $check = calculateCheckNumber($birthdate . $separator . $serial, TYPE_PERSON);
        } while ($check === false);
        return $birthdate . $separator . $serial . $check;
    }

    /**
     * Generate random business id
     *
     * @return string
     */
    public static function companyIdent(): string
    {
        do {
            $base = (string)mt_rand(0, 9999999); // start with some random number
            $base = str_pad($base, 7, '0', STR_PAD_LEFT); // make sure it's 7 digit
            try {
                $check = calculateCheckNumber($base, TYPE_COMPANY); // try to calculate check number
            } catch (BadMethodCallException $e) {
                unset($e);
                $check = false; // in case we had a bad base number
            }
        } while ($check === false);
        return "$base-$check";
    }
}
