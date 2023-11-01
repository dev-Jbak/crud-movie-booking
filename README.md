# Cinema movie booking RESTful API

This is a bare-bones example of a movie booking application providing a REST API to be ablw to create, update, delete and view bookings.


A cinema contains screens with seats, which can have movies played at different showing times.
Where you book a showing for a movie and the seat allocated automatically if availablity.

### Structure

Screen
  -> Seats

Showing
  -> Movie
  -> Time

Booking
  -> Seat
  -> Showing


## Install

    composer install

## Run the app

    php artisan serve

## Setting up the data

    php artisan migrate:fresh --seed

## Run the tests

    php artisan test



# REST API

The REST API to the movie app is described below.


## Customers

### Get all

`GET /api/customers`

### Get specific

`GET /api/customers/{ID}`

### Create new

`POST /api/customers`

```
Required Fields
- Name
- Email
```

### Update

`PUT /api/customers/{ID}`

Fields
- Name
- Email

### Delete

`DELETE /api/customers/{ID}`



## Movie

### Get all

`GET /api/movies`

### Get specific

`GET /api/movies/{ID}`

### Create new

`POST /api/movies`

```
Required Fields
- Name (Unique)
```

### Update

`PUT /api/movies/{ID}`

```
Fields
- Name (Unique)
```

### Delete

`DELETE /api/movies/{ID}`



## Showings

### Get all

`GET /api/showings`

### Get specific

`GET /api/showings/{ID}`

### Get showing seat avaliablity

`GET /api/showings/{ID}/seat-availability`

### Create

`POST /api/showings`

```
Required Fields
- Screen ID
- Movie ID
- Time
```

### Update

`PUT /api/showings/{ID}`

```
Required Fields
- Screen ID
- Movie ID

Fields
- Time
```

### Delete

`DELETE /api/showings/{ID}`



## Bookings

### Get all

`GET /api/bookings`

### Get specific

`GET /api/bookings/{ID}`

### Create

`POST /api/bookings`

```
Required Fields
- Customner ID
- Showing ID
- Seats (total)
```


### Update

`PUT /api/bookings/{ID}`

```
Required Fields
- Customner ID
- Showing ID
- Seat ID
```

### Delete

`DELETE /api/bookings/{ID}`
