# **JSON and XML Schemas for WebSTAMP**

This repository contains the modified source code of WebSTAMP, a software tool designed to assist safety and security analysts in applying the STPA (Systems-Theoretic Process Analysis) technique. In this modified version, XML and JSON schemas have been incorporated using XSD and JSON Schema technologies, respectively. These schemas were implemented to enable the export and import functionalities of hazard analyses between WebSTAMP and other software tools compatible with the schemas. To validate these additional functionalities, we incorporated the schemas into a second tool and conducted tests using examples of hazard analyses presented in the literature. The schemas created for WebSTAMP provided portability for hazard analyses, allowing an analysis created in WebSTAMP to be used in other applications supporting the schemas, and vice versa. The results obtained allow us to conclude that XML and JSON schemas compatible with STPA assist safety and security analysts, making the task of conducting hazard analyses more flexible, as they allow analysts to use the tools of their choice, including the possibility of using multiple tools and leveraging the advantages of each.

Following are the main contributions of this work:

- JSON and XML Schemas: `app/Schemas`.
  - Contains the JSON and XML schemas used by the application to define the structure and format of the hazard analyses.
- Methods for importing and exporting analyses: `app/Http/Controllers/ProjectController.php`.
  - Contains the methods responsible for the logic of importing and exporting analyses within the WebSTAMP.

# **Use case: WebSTAMP**

Using the JSON and XML schemas developed in this work, we implemented import and export functionalities for hazard analyses (projects) in WebSTAMP. This is the WebSTAMP home page, designed to provide users with an introduction to the concepts of STAMP (Systems-Theoretic Accident Modeling and Processes) and STPA, as well as information about WebSTAMP and how to use it for conducting STPA analyses. Additionally, on this page, users have the option to log in or create a new account:

![The WebSTAMP home page](https://github.com/GustavoHenriqueSant/WebSTAMP_with_import_export_modules/assets/71770334/11e18dfa-91d0-4210-b1ee-2b7c9cf96e62)

After the authentication process, users are directed to a page where they can access the projects (hazard analyses) they have created within WebSTAMP. In the case of a newly registered user, this page will be empty, as there are no projects associated with their account yet.

![Projects page](https://github.com/GustavoHenriqueSant/WebSTAMP_with_import_export_modules/assets/71770334/0ad9846f-ab91-4dad-81da-fdb2b4bf0877)

## Importing a hazard analysis:

In the import process, the user must upload the analysis in JSON or XML format:

![Importing a hazard analysis](https://github.com/GustavoHenriqueSant/WebSTAMP_with_import_export_modules/assets/71770334/5b792b31-7d3f-483d-8267-2e75441c0fa0)

The schemas defined in this work are used to validate analyses in JSON or XML format. When an analysis is submitted for import, it undergoes a compliance check with the corresponding schemas. If the analysis is compliant, the data is persisted in the WebSTAMP database, resulting in the creation of a new project in the tool:

![Succesfully import](https://github.com/GustavoHenriqueSant/WebSTAMP_with_import_export_modules/assets/71770334/487332a9-6296-48a4-be6d-46d792098bd8)

## Exporting a hazard analysis:

Users have the option to export hazard analyses conducted in WebSTAMP in JSON or XML format:

![Exporting a hazard analysis](https://github.com/GustavoHenriqueSant/WebSTAMP_with_import_export_modules/assets/71770334/15d89777-9933-4362-89e8-6d93135c621d)

After the user indicates their choice, the analysis is downloaded in the chosen format:

![Succesfully export](https://github.com/GustavoHenriqueSant/WebSTAMP_with_import_export_modules/assets/71770334/6580d1e4-418f-48ac-8bc6-bbb5c83fb358)

For readers interested in exploring the additional features of WebSTAMP, as demonstrated in this section, have the option to use a sample analysis available in the `docs` directory. This analysis, titled 'Train Door System', is available in XML and JSON formats.

# **JSON and XML Schemas validation**

To validate the created JSON and XML schemas, we used two examples of hazard analyses found in the literature: a train door controller and an insulin pump. To enable validation, we modified the WebSTAMP source code to include import/export functionalities for hazard analysis. Additionally, we developed a small desktop application, independent of WebSTAMP, also equipped with import and export functionalities for hazard analyses, to simulate the portability of analyses between the two tools.

The figure below illustrates the experiment conducted to validate the implemented JSON and XML schemas. The scenario described in the figure encompasses (starting from the top left corner) a hazard analysis created in WebSTAMP, exported in JSON format, and imported into an independent application. After importation by the independent application, the hazard analysis is edited and exported again, to be imported once more by WebSTAMP. The analysis imported back into WebSTAMP incorporates the updates made in the analysis by the independent application, demonstrating the portability of the analysis between software tools and the flexibility granted to security analysts when selecting the appropriate tool for analysis.

[IMAGE HERE]

For readers interested in replicating the experiment, the source code of the independent tool can be found in a separate repository ([link](https://github.com/GustavoHenriqueSant/JSON_and_XML_Schemas_Independent_tools/tree/master)). The readme of this repository contains more information to replicate the experiment.

# **A rule-based tool for System-Theoretic Process Analysis (STPA)**

TO DO

## **Prerequisites**

For execution of all commands, it is necessary the use of [Composer](https://getcomposer.org/download/) and [Node.js](https://nodejs.org/en/download/)

## **Installation**

Open a bash/git bash to clone the repository

```
#!npm
git clone https://bitbucket.org/FellipeRey/stpatool
```


In stpatool folder, we need install Gulp, an automated task runner. Typing the command below, a new folder (node_modules) will be created with the content of Gulp.

```
#!npm
npm install -g gulp
```


To install the remaining dependencies, execute the command:

```
#!npm
npm install
```


Some Laravel folders (like vendor) do not change, so it is not necessary to send them to the repository, it can be obtained through the command:

```
#!composer
composer install
```



Gulp is the responsible to get all views, css, images and javascripts files(folder resources), compile them and send to the public folder.

```
#!composer
gulp
```



**Attention!**

1. Create a new .env file. Copy the content of .env.example and modify using your database configuration


2. Create a schema in your database named "stpatool"


3. To create all tables automatically, just type:





A new key must be generated for the new Laravel application. 

```
#!composer
php artisan key:generate
```

To create the database

```
#!mysql

php artisan migrate --seed
```

## **Running the application**

After complete the Installation, you must open two bashes and execute the commands:

```
#!bash

php artisan serve
```
and
```
#!bash

gulp watch
```

**Attention! ** If no change in the resources folder, it is not necessary to run the second command (gulp watch)


## **About Laravel**

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/d/total.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, queueing, and caching.

Laravel is accessible, yet powerful, providing tools needed for large, robust applications. A superb inversion of control container, expressive migration system, and tightly integrated unit testing support give you the tools you need to build any application with which you are tasked.


## **Laravel Documentation**

Documentation for the framework can be found on the [Laravel website](http://laravel.com/docs).

## **Laravel Contributing**

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](http://laravel.com/docs/contributions).

## **Laravel Security Vulnerabilities**

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## **Laravel License**

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
