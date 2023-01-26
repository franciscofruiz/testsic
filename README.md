# Testsic
Prueba de PHP por Francisco Fabian Ruiz

# Requerimientos:
Para que la aplicación funcione se debe contar con los siguientes requerimientos:
- PHP 7.4.9
 - php mysqli extension
- MYSQL 5.7.31
- APACHE 2.4.46

Si no se cuenta con las dependencias requeridas se puede instalar WampServer 3.2.9 el cual trae las anteriores versiones.

**Instalación:**

1. Clonar con el comando:
   git clone git@github.com:franciscofruiz/testsic.git testsic 
   
   O descargar el codigo fuente en formato zip (testsic-main.zip) desde https://github.com/franciscofruiz/testsic

2. Mover el directorio con el codigo fuente en la carpeta www o document root definido en la configuración de apache. 
   Si se está usando wamp, en la ruta de instalacion del mismo en la carpeta /www/testsic/

3. **config.php**. En este archivo se puede configurar la base de datos y el path relativo de la aplicación.

   3.1 Si por alguna razón el codigo se instala en otra carpeta diferente "testsic". Ingresar al archivo "testsic/config.php" y
   modificar la linea $relative_path = '/testsic';  con el nombre que corresponda al directorio.

   3.2. En el archivo se encuentran tambien  establecidas las credenciales por defecto para conexion a la base de datos. 

`    'servername' => 'localhost',`
    `'username' => 'testsic',`
    `'password' => 'testsic',`
    `'db_name' => 'testsic'`

**NOTA** En caso de mantenerse la configuración por defecto en el punto 4 se describe como crear un usuario con todos los privilegios sobre la base de datos.


4. Estructura de la base de datos y seeds iniciales. Usar phpmyadmin, consola de mysql  o cualquier cliente para mysql server para crear la base de datos **antes de importar los archivos SQL**. Los comandos a continuación se pueden ejecutar en la consola de mysql.

  4.1. Crear la base de datos. `CREATE DATABASE testsic;`

  4.2. (Opcional) Crear el usuario por defecto configurado en el demo. `grant all on testsic.* to testsic@localhost identified by 'testsic' with grant option;`

  4.3. **db.sql** : contiene la estructura de la base de datos, importar a mysql a traves de phpmyadmin o ejecutando desde el prompt de mysql:
    `source /path/donde/esta/el/archivo/db.sql`

  4.4 **seeds.sql** : contiene un bulk de datos de prueba, incluyendo dos usuarios de prueba **activos**, test@test.com con password test_123456 y test2@test.com  con password test2_123456
    `source /path/donde/esta/el/archivo/seeds.sql`

**NOTA** Las contraseñas estan encriptadas a nivel de base de datos por tanto no son visibles a simplevista.  uso el algoritmo por defecto de php `password_hash` para encriptación.

![Mysql Console](https://www.faroti.com/mysql-console.png)

5. El aplicativo ya está instalado y listo para funcionar. Ingresar a http://localhost/testsic/

6. Existe una tabla con logs para todos los movimientos que se realicen en las radicaciones, con fecha y hora, el nuevo contenido de la radicación y el usuario que la creó o modificó.