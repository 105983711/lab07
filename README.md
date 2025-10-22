# Car Database Project

A simple PHP and MySQL application to manage and search a car inventory.

## Files Needed

- `settings.php` - Database connection settings
- `cars.php` - Main page showing all cars
- `search_form.php` - Search page
- `search_result.php` - Shows search results
- `setup_database.sql` - Creates the database and sample data

## Setup Instructions

1. **Start XAMPP**
   - Open XAMPP and start Apache and MySQL

2. **Create the Database**
   - Open phpMyAdmin at `http://localhost/phpmyadmin`
   - Create a new database called `exhibition_db`
   - Run the SQL commands from `setup_database.sql`

3. **Add the PHP Files**
   - Place all PHP files in `htdocs/lab08/` folder

4. **Test the Application**
   - Go to `http://localhost/lab08/cars.php`
   - You should see 5 cars displayed
   - Try the search feature

## Sample Data

The database includes these cars:
- Holden Astra - $14,000 - 2009
- BMW X3 - $35,000 - 2010  
- Ford Falcon - $39,000 - 2013
- Toyota Corolla - $20,000 - 2012
- Holden Commodore - $28,000 - 2009

## Features

- View all cars in a nice table
- Search for cars by model name
- Clean, simple interface
- Safe database queries

## If Something Doesn't Work

- Make sure MySQL is running in XAMPP
- Check the database name is `exhibition_db`
- Verify all files are in the correct folder
- Try searching for "corolla" or "bmw" to test

