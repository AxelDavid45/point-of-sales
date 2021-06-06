# 💰Point of sales system💰
This is the first release of this POS containing some useful features.


## Installation

***First you need to download docker on your machine in order to run the local environment.***

```bash
# move to the repository
cd point-of-sales

# start the services with docker-compose
docker-compose up -d 

# To run any command like 'php artisan' 'npm install' run it inside the container
docker-compose exec app <your-command>

# Example to lift up the migrations
docker-compose exec app php artisan migrate --seed
```


## Features 👌
- Manage your clients.
- Manage your products.
- Manage your sales.
- Create categories and group your products.
- Create a report of your whole sales per day in Excel.
- Manage users in your system (this feature will be improved, we can't assign roles yet).

## Future Changes ⚠
I will improve the system little by little, adding new features.
Now we use vanilla Javascript in the sales section for speed up the creation of new sales, the next steps will create an API using authentification and try to consume it with Javascript in the frontend.
For this reason, I have to learn about APIs, javascript frameworks, and other technologies.

## Features

Coming soon.

