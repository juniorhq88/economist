# The Economist Test

Proyecto de prueba técnica que implementa una aplicación web utilizando Laravel y React.

## 🚀 Tecnologías Utilizadas

### Backend
- Laravel (versión 11)
- MySQL
- Laravel Sanctum para autenticación

### Frontend
- React.js
- Tailwind CSS / Bootstrap (opcional)

## 🔧 Instalación

### 1. Clonar el Repositorio

```bash
git clone https://github.com/tu_usuario/tu_proyecto.git
cd tu_proyecto
```

### 2. Configuración del Backend

#### Instalar Dependencias
```bash
composer install
```

#### Configurar Variables de Entorno
```bash
cp .env.example .env
```
- Editar el archivo `.env` con la configuración correcta de:
  - Base de datos
  - Servicios adicionales
  - Otras configuraciones necesarias

#### Generar Clave de Aplicación
```bash
php artisan key:generate
```

#### Migrar Base de Datos
```bash
php artisan migrate --seed
```

#### Iniciar el Servidor de Desarrollo
```bash
php artisan serve
```

### 3. Configuración del Frontend

#### Instalar Dependencias
```bash
npm install
```

#### Iniciar el Servidor de Desarrollo
```bash
npm run dev
```

## 👤 Autenticación

El sistema implementa autenticación API mediante Laravel Sanctum. Todas las rutas protegidas requieren un token de autenticación válido.

## 📝 Notas Adicionales

- Asegúrese de tener instalados todos los requisitos previos (PHP 8.x, Composer, Node.js, MySQL)
- Para entornos de producción, configure adecuadamente los archivos de entorno
- Consulte la documentación oficial de Laravel y React para más detalles sobre la configuración avanzada

## 🤝 Contribución

Si desea contribuir al proyecto, por favor:
1. Haga fork del repositorio
2. Cree una rama para su característica
3. Envíe un pull request

## 📄 Licencia

Este proyecto está bajo la Licencia MIT.