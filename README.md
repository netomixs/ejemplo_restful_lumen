# Proyecto LumenPHP

## Tabla de Contenidos

1. [Descripción](#descripción)
2. [Servicios y Métodos](#servicios-y-métodos)
3. [Instalación](#instalación)
4. [Configuración](#configuración)
5. [Requerimientos Mínimos](#requerimientos-mínimos)
6. [Uso](#uso)
7. [Contribuir](#contribuir)
8. [Licencia](#licencia)

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