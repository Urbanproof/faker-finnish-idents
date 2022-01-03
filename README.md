# Faker provider for finnish national id's & business id's


## TODO:
- publish package
- add national id generator

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
