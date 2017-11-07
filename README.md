parser api
=========

A Symfony project created on October 24, 2017, 11:19 pm.


Instruction
----
1. copy app/config/parameters.yml.dist to app/config/parameters.yml and setup your data  


2. run in root of project: 

```
composer update  
php bin/console doctrine:database:create  
php bin/console doctrine:schema:update --force  
```

3. load categories:  
```
php bin/console ik:load:categories
```

4. load products:  
```
php bin/console ik:load:products
```

5. create dump and use database - profit.