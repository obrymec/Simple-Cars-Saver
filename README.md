# Simple Cars Saver
![](https://img.shields.io/badge/javascript-%20ES5-orange)
![](https://img.shields.io/badge/mysql-%208.0-green)
![](https://img.shields.io/badge/css-%203-lightgrey)
![](https://img.shields.io/badge/jquery-%201.5-blue)
![](https://img.shields.io/badge/sql-%2013.0-orange)
![](https://img.shields.io/badge/html-%205-blue)
![](https://img.shields.io/badge/php-7.4-blue)

This small project is an academy project. The main goal of this app is to be able to save owners's cars. This app uses native Web Development Languages on front-end and PHP on back-end to manage client requests. PhpMyAdmin and MySQL is used to control app database. The communication between front-end and back-end uses AJAX method and JSON to transfer data from the front-end to back-end.

## Final result
This is the final result of the project:<br/><br/>
![](./render-1.png)
![](./render-2.png)
![](./render-3.png)
![](./render-4.png)

## Project installation

### <u>Install XAMPP or WAMP</u>:
- For XAMPP downloading, you can find it at this link: <a href = "https://www.apachefriends.org/fr/download.html">https://www.apachefriends.org/fr/download.html</a>
- For WAMP downloading, you can find it at this link: <a href = "https://www.wampserver.com/en">https://www.wampserver.com/en/</a>

### <u>Project cloning</u>:
```sh
git clone git@github.com:obrymec/Simple-Cars-Saver.git simple-cars-saver/
```

### <u>Tasks before run the project</u>:
After you clone the project, you should do the following tasks before run it:
- Move the project folder to your Wampp or Xampp server folder;
- Turn on your Wampp or Xampp server;
- Go to phpMyAdmin in your favorite browser or via the link: http://localhost/phpmyadmin/
- Create a database named exactly like this: <i><strong>cars_saver</strong></i>;
- Select the newly created database;
- Click on the <i><strong>Import</strong></i> tab at the top;
- Click on the <i><strong>Choose a file</strong></i> button in the <i><strong>File to import</strong></i> section;
- Load the file <i><strong>tables.sql</strong></i> located at the root of the project;
- Then click on the <i><strong>Import</strong></i> button located at the very bottom of the page.<br/>
After this operation, you will see that tables have been automatically created in your database named <i><strong>cars_saver</strong></i>.
- Select the <i><strong>marque</strong></i> table and fill it with the brands of your choice.<br/>
Now you are ready to run the project.

### <u>Run project</u>:
To navigate between project views, you can uses the following below links:
- http://localhost/simple-cars-saver/_listeProprietaire.html
- http://localhost/simple-cars-saver/ajoutVehiPropri.html
- http://localhost/simple-cars-saver/ModifVehicule.html
- http://localhost/simple-cars-saver/AjoutModele.html

<u><strong>NB</strong></u>: Make sure that the project folder name is: <i style = "color: skyblue;"><strong>simple-cars-saver</i></strong>

Enjoy :)
