# Diego Navarro - Extensiones

**Versión:** 1.1  
**Autor:** Diego Navarro  
**Descripción:** Este plugin añade funciones personalizadas y configuraciones adicionales al sitio web de Diego Navarro.

## Descripción

El plugin **Diego Navarro - Extensiones** ha sido diseñado para proporcionar funcionalidades específicas al sitio web de Diego Navarro, como la protección de páginas mediante autenticación por contraseña o token, la desactivación de actualizaciones automáticas de ciertos plugins, y la capacidad de registrar e inspeccionar intentos de inicio de sesión.

## Características

- **Autenticación personalizada:** Autenticación mediante contraseña y/o token para proteger el acceso a páginas específicas.
- **Desactivación de actualizaciones:** Bloquea actualizaciones automáticas para ciertos plugins seleccionados.
- **Registro de intentos de inicio de sesión:** Registra cada intento de inicio de sesión, tanto exitoso como fallido, en un archivo de log accesible desde el panel de administración de WordPress.
- **Plantillas personalizadas:** Añade una plantilla personalizada "Ingreso" que puede ser seleccionada desde el editor de páginas de WordPress.

## Archivos y Directorios

- `diego-navarro-extensiones.php`: Archivo principal del plugin donde se definen las constantes, se incluyen otros archivos, y se inicializan las funciones.
- `includes/init.php`: Maneja la autenticación y validación de tokens.
- `includes/auth.php`: Contiene las funciones para manejar la autenticación y el login.
- `includes/pages.php`: Añade plantillas personalizadas y maneja su carga.
- `includes/settings.php`: Archivo donde se manejan las configuraciones adicionales del plugin.
- `includes/log-ingreso.php`: Archivo que gestiona los registros de intentos de inicio de sesión.
- `logs/login_attempts.log`: Archivo donde se almacenan los registros de intentos de inicio de sesión.
