# Workshop DDD x API Platform

This is a demo project used for the DDD x API Platform Workshop by @chalasr & @mtarld from @coopTilleuls.

## Getting started

1. Run `git clone https://github.com/mtarld/apip-ddd` to clone the project
1. Run `make install` to install the project
1. Run `make start` to up your containers
1. Visit https://localhost/api and play with your app!

## :warning: Temporary dependencies

As [API platform](https://github.com/api-platform/core) 3 isn't released yet, that repository is using the `dev-main`
branch of `api-platform/core`.
As soon as API Platform is released (it should happen very soon), the `v3` tag must be targetterd and the `minimum-stability` must be updated.

## Exercises

### 1. The domain layer

> First, checkout the exercise tag: `git checkout exercise1 -b exercise1`
>
> *You can compare your code to the solution using `git show exercise1-solved`*

<details>
  <summary>1.1 - Adding a name</summary>

  - Let's create a `App\BookStore\ValueObject\BookName` value object
  - This `BookName` will have to hold a value (string)
  - That value length have to be less that 255
  - Now, create a `rename` method in `Book` to change the `BookName`
  - You'll have to update the `DummyBookFactory` to handle the name
  - Finally, update the `BookTest::testRename` to test your use case

</details>

<details>
  <summary>1.2 - Applying a discount</summary>

  - Let's add a price to books
  - That price should always be greater than 0
  - The `Book` model must have a method that will apply a discount percentage on the price
  - You'll have to update the `DummyBookFactory` to handle the price creation
  - Finally, update the `BookTest::testApplyDiscount` to test your use case

</details>

<details>
  <summary>1.3 - Integrating Doctrine</summary>

  - Let's add the proper `ORM\Entity`, `ORM\Embedded`, `ORM\Embeddable` and `ORM\Column` PHP attributes on value objects and models
  - Have a look at the `DoctrineRepository` class
  - Implement the missing methods in the `DoctrineBookRepository`
  - Finally, have a look at the `DoctrineBookRepositoryTest` and fill the missing test cases

</details>

### 2. The application layer

> First, checkout the exercise tag: `git checkout exercise2 -b exercise2`
>
> *You can compare your code to the solution using `git show exercise2-solved`*

<details>
  <summary>2.1 - Finding a book</summary>

  - Let's create a `App\BookStore\Application\Query\FindBookQuery` query
  - That query will just hold the book id
  - Now let's update the associated handler so that it uses the query and the repository to retrieve a book by its id
  - Finally, update the `FindBookTest` to test functionally what you've just coded (using the query bus)

</details>

<details>
  <summary>2.2 - Applying a discount</summary>

  - Let's create a `DiscountBookCommand` and its handler that will apply a discount on a specific book
  - Then, update the `DiscountBookTest` to test functionally what you've just coded (using the command bus)

</details>

### 3. The infrastructure layer (and API Platform!!)

> First, checkout the exercise tag: `git checkout exercise3 -b exercise3`
>
> *You can compare your code to the solution using `git show exercise3-solved`*

<details>
  <summary>3.1 - Finding a book</summary>

  - Let's update the `BookResource` to specify the `BookItemProvider` in the `Get` operation
  - Fill in the `BookItemProvider` and dispatch the `FindBookQuery` to return (or not) a book based on the id
  - Update the `FindBookTest` acceptance test to really test the API

</details>

<details>
  <summary>3.2 - Applying a discount</summary>

  - Let's update the `BookResource` to specify the proper provider and processor
  - You can now create the proper processor to apply a discount on a book (and return the updated book)
  - Update the `DiscountBookTest` acceptance test to really test the API

</details>

### 4. Bounded contexts

> First, checkout the exercise tag: `git checkout exercise4 -b exercise4`
>
> *You can compare your code to the solution using `git show exercise4-solved`*

<details>
  <summary>4 - Handling subscriptions</summary>

  - Let's update the `Subscription` entity to make it as an API resource (with `Post` and `Delete` operations only)
  - Update API Platform's configuration to handle resources in the `Subscription` bounded context
  - Update the `SubscriptionCrudTest` acceptance test

</details>

## Authors
[Mathias Arlaud](https://github.com/mtarld) and [Robin Chalas](https://github.com/chalasr)

