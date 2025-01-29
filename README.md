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
git clone https://github.com/juniorhq88/economist.git
cd tu_proyecto/backend
```

### 2. Configuración del Backend

#### Instalar Dependencias

```bash
composer install
npm install
npm run build
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
cd tu_proyecto/frontend
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
