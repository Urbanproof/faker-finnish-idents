<?php

use function Urbanproof\FakerIdents\calculateCheckNumber;
use const Urbanproof\FakerIdents\TYPE_COMPANY;

#region Verify with valid company idents

it('ceates correct check numbers for companies', function (string $input, int $correctCheck): void {
    $calculatedCheck = calculateCheckNumber($input, TYPE_COMPANY);
    expect($calculatedCheck)->toEqual($correctCheck)->not->toThrow(Exception::class);
})->with([
    ['2340628', 1],
    ['3178266', 6],
    ['2658075', 2],
    ['0444724', 8],
    ['8775305', 5],
    ['1447865', 4],
    ['5650787', 1],
    ['6384622', 2],
    ['7847034', 4],
    ['2828600', 4],
    ['4716632', 3],
    ['4887202', 7],
    ['6211764', 2],
    ['3734278', 4],
    ['0076527', 3],
    ['0127811', 9],
    ['5274061', 7],
    ['0714533', 3],
    ['8115744', 7],
    ['1721852', 4],
    ['6053663', 2],
    ['6025550', 7],
    ['3041331', 6],
    ['0111554', 7],
    ['4420073', 3],
    ['6408581', 6],
    ['0781747', 8],
    ['8420182', 9],
    ['5045765', 8],
    ['5317488', 0],
    ['6257667', 0],
    ['0774084', 5],
    ['7350611', 7],
    ['3756166', 1],
    ['2238257', 2],
    ['7860075', 1],
    ['5334043', 9],
    ['6254443', 3],
    ['3804817', 3],
    ['4456260', 3],
    ['4705357', 2],
    ['4221224', 7],
    ['8636043', 6],
    ['8640570', 2],
    ['8766632', 2],
    ['3570857', 8],
    ['6636834', 2],
    ['6102154', 2],
    ['1446765', 6],
    ['4544715', 6],
]);

#endregion


#region Verify with invalid company idents

it('fails if input length is not 7 or is not numeric', function ($input): void {
    expect(fn () => calculateCheckNumber($input, TYPE_COMPANY))->toThrow(BadMethodCallException::class);
})->with([
    'asdf',
    'asdfghj',
    '1',
    '1234',
    '123456789',
]);

it('fails if check number modulo would be 1', function ($input): void {
    expect(fn () => calculateCheckNumber($input, TYPE_COMPANY))->toThrow(BadMethodCallException::class);
})->with([
    '1234568',
    '0000006',
    '2345673',
]);

#endregion
