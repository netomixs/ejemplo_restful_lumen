# Proyecto LumenPHP

## Tabla de Contenidos

1. [Descripción](#descripción)
2. [Servicios y Métodos](#servicios-y-métodos)
3. [Instalación](#instalación)
4. [Configuración](#configuración)
5. [Requerimientos Mínimos](#requerimientos-mínimos)
6. [Uso](#uso)
7. [Log](#log)
 

# Descripción

Este proyecto es una API construida utilizando el micro-framework LumenPHP. Proporciona varios servicios para la gestión de clientes y registro de eventos en logs.

## Servicios y Métodos

### Respuesta generica

```json
{
    "IsSuccess": boolean,
    "Data":any,
    "Message": string
}
```

### Obtener token

**Ruta**: `/login`

**Método**: `POST`

**Body**:

-   `user` string
-   `password` string

**Respuesta**:

```json
{
   {"IsSuccess":true,
   "Data":{
    "id_cred":int,
    "user":string,
    "token":string },
    "Message":"Acceso correcto"}
}
```

**Credenciales por defecto**:

-   `user`: netomix
-   `password`: 123456

### Bearer Token

#### Una vez que tengas el Bearer token, debes incluirlo en el encabezado de Autorización

```
- Authorization: Bearer token
```

#### Ejemplo

```sh
curl -X POST /costumer \
     -H "Authorization: Bearer token" \
     -H "Content-Type: application/json" \
     -d '{
           "data": any
         }'
```

### Obtener Cliente por DNI o Email

**Ruta**: `/customers`

**Método**: `GET`

**Parámetros**:

-   `dni` (opcional): El DNI del cliente.
-   `email` (opcional): El email del cliente.

**Respuesta**:

```json
{
    "IsSuccess": boolean,
    "Data": {
        "name": string,
        "last_name": string,
        "address": string|null,
        "region": { "description": string},
        "commune": { "description": string }
    },
    "Message": string
}
```

### Insert cliente

**Ruta**: `/customers`

**Método**: `POST`

**Body**:

-   `dni` string
-   `email` string
-   `name` string
-   `lastName` string
-   `address`string | null
-   `status` char max 1
-   `region` int
-   `commune` int

**Respuesta**:

```json
{
    "IsSuccess": boolean,//Estado de la solicitud
    "Data": "",//Datos de la solicitud
    "Message": string// Informacion de la solicitud
}
```

### Eliminar cliente

**Ruta**: `/customers`

**Método**: `DELETE`

**Parametro**:

-   `dni` string

**Respuesta**:

```json
{
    "IsSuccess": boolean,//Estado de la solicitud
    "Data": "",//Datos de la solicitud
    "Message": string// Informacion de la solicitud
}
```
## Instalación
### Proyecto
Copia el proyecto e ingresa a la carpeta del mismo
````bash
git clone  https://github.com/netomixs/ejemplo_restful_lumen
cd ejemplo_restful_lumen
````

Ingresa hasta el mimo drectorio donde se encuentre y ejecuta `composer.json `

```bash
composer install
````
Agrega el archivo `.env` a la raiz del proyecto
### Base de datos
Crea una base de datos e importa el archivo de tablas `Tablas.sql`
## Configuración
Agregar las varibles de entorno al archivo `.env`
````env
APP_NAME=Lumen
APP_ENV=local
APP_DEBUG=false
APP_URL=http://localhost
DB_CONNECTION=mysql
DB_HOST=  host de la base de datos
DB_PORT= puerto de la base de datos
DB_DATABASE=nombre de la base de datos
DB_USERNAME=usuario de la base de datos
DB_PASSWORD= contraseña de la base de datos
                              
JWT_SECRET=palabra_seceta
```` 
**Ejemplo**
````env
APP_NAME=Lumen
APP_ENV=local
APP_KEY=
APP_DEBUG=false
APP_URL=http://localhost
APP_TIMEZONE=UTC
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mydb
DB_USERNAME=root
DB_PASSWORD=
JWT_SECRET=palabra_seceta
```` 
## Requerimientos Mínimos
- `PHP >= 8.0.3`
- `Composer`
- `Base de datos MySQL o MariaDB`

## Uso
Para levantar el servidor de desarrollo, usa el siguiente comando desde la raiz del proyecto:
````bash
php -S localhost:8000 -t public
````
## Log
El resgitro de log se encuentra en el directorio `storage\logs\events.log`