<?php

use Faker\Factory;
use Urbanproof\FakerIdents\IdentProvider;

test('this library can be added as a provider', function (): void {
    $faker = Factory::create();
    $ourProvider = new IdentProvider($faker);
    $faker->addProvider($ourProvider);
    expect($faker->getProviders())->toContain($ourProvider);
    expect($faker->getFormatter('companyIdent'))->toBeCallable();
    expect($faker->getFormatter('personIdent'))->toBeCallable();
});

test('our formatters can be called', function (): void {
    $faker = Factory::create();
    $faker->addProvider(new IdentProvider($faker));
    expect($faker->companyIdent)->toBeString();
    expect($faker->personIdent)->toBeString();
});
