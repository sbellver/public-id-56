# Public IDs in Laravel

This package automatically generates public ID for your Eloquent models.

## What is a public ID and what are its advantages?

Most of your projects probably have the `id` auto-incremental field. There are many disadvantages of using that field to displaying resource (e.g. in routing: `/posts/{id}`). That's where public ID comes in place. Think of them like UUID but shorter and with no separator.

## Installation
### Step 1: Install the dependency
From the command line, run:
```
composer require crnkovic/public-id
```

This command will download and install the package into your *vendor* folder.

### Step 2: Add service provider
Open up `config/app.php` and add the following line within your `providers` array:
```php
Crnkovic\PublicID\PublicIDServiceProvider::class
```
This step will *plug* the package into your Laravel application.

### Step 3: Publish the configuration file
From the command line, run:
```
php artisan vendor:publish --provider="Crnkovic\PublicID\PublicIDServiceProvider"
```

## Usage
### Adding the column to your database schema
Add the `Crnkovic\PublicID\PublicID::column($table)` line inside your Laravel migration.
Example:
```php
use Crnkovic\PublicID\PublicID;

Schema::create('users', function (Blueprint $table) {
    $table->increments('id');
    PublicID::column($table);
});
```

### Including the trait
Just include the `Crnkovic\PublicID\HasPublicID` trait inside of your Eloquent model, and **that's it**. Now, on every model creation your public ID will be added and on every update, **no public ID will be changed**.

```php
use Crnkovic\PublicID\HasPublicID;

class Post extends Model
{
    use HasPublicID;
}
```

## Configurating
You can configure the package to your own needs. The keys in the configuration file are as specified below.

| Key | Type | Description | Default value |
| ------ | ------ | ------ | ------ |
| `key` | String | Name of the column in the database | `env('PUBLIC_ID_KEY', 'public_id')` |
| `size` | Integer | Size of the key | 10 |
| `alphabet` | String | Characters used for generating a key | English alphabet |