# Faker provider for finnish national id's & business id's


## TODO:
- publish package
- write tests for person idents

## Installation

```sh
composer urbanproof/faker-finnish-idents
```
or add
```sh
"urbanproof/faker-finnish-idents": "^1.0"
```

## Add provoder to Faker
```php
$faker = (new \Faker\Factory())::create();
$faker->addProvider(new Urbanproof\FakerIdents\IdentProvider($faker));
```

## Usage

### Generate business id
```php
echo $faker->companyIdent; // => "5235981-6"
```

### Generate national id
```php
echo $faker->personIdent; // => "170379-921F"
```

```php
echo $faker->personIdent(DateTime::createFromFormat('d.m.Y', '01.01.2000'); // => "010100A3967"
```

```php
use const Urbanproof\FakerIdents\GENER_MALE;
echo $faker->personIdent(DateTime::createFromFormat('d.m.Y', '31.12.1999'), GENER_MALE); // => "311299-4059"
```
