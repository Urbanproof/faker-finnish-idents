<?php

namespace Urbanproof\FakerIdents;

use BadMethodCallException;
use OutOfBoundsException;
use RuntimeException;

const TYPE_PERSON = 'person';
const TYPE_COMPANY = 'company';
const GENER_MALE = 'male';
const GENER_FEMALE = 'female';

function calculateCheckNumber(string $input, string $type): int
{
    switch ($type) {
        case TYPE_COMPANY:
            if (!is_numeric($input)) {
                throw new BadMethodCallException('Invalid input, only numbers allowed');
            }
            if (mb_strlen($input) !== 7) {
                throw new BadMethodCallException('Company ident must be exactly 7 numbers without the check number');
            }
            $numbers = str_pad(mb_substr($input, 0, 7), 10, '0', STR_PAD_LEFT);
            $sum = 0;
            // Checksum calculation is based on ISO-7064, which uses 6^i mod 11 * value where i is position 0...10
            foreach (str_split($numbers) as $index => $value) {
                $sum += 6 ** $index % 11 * $value;
            }
            $check = $sum % 11;
            switch ($check) {
                case 0:
                    return 0;
                case 1:
                    throw new BadMethodCallException('Company ident check number cannot be 1');
                default:
                    return 11 - $check;
            }
        case TYPE_PERSON:
            throw new RuntimeException('Person ident check number calculation is not implemented yet');
        default:
            throw new OutOfBoundsException('Unknown ident type.');
    }
}
