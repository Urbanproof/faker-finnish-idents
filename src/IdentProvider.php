<?php

namespace Urbanproof\FakerIdents;

use BadMethodCallException;
use Faker\Provider\Base;
use RuntimeException;

class IdentProvider extends Base
{
    /**
     * Generate random national identity number. Not implemented yet.
     *
     * @return string
     */
    public static function personIdent(?string $gender = null): string
    {
        throw new RuntimeException('Method not implemented yet');
    }

    /**
     * Generate random business id.
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
