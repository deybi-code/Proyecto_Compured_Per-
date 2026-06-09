# Docker — Compured Peru

## Archivos que debes copiar a tu proyecto

```
tu-proyecto/
├── Dockerfile
├── docker-compose.yml
├── .env.docker          ← renómbralo a .env (o créalo aparte)
└── docker/
    ├── nginx.conf
    ├── supervisord.conf
    └── php.ini
```

---

## Paso a paso para levantar con Docker Desktop

### 1. Copia los archivos a la raíz de tu proyecto

### 2. Crea el archivo `.env` con tus valores reales

```bash
cp .env.docker .env
```

Edita `.env` y pon:
- `APP_KEY` — genera uno con: `php artisan key:generate --show`
- `DB_PASSWORD` — la contraseña que quieras para la base de datos
- `DB_ROOT_PASSWORD` — contraseña root de MySQL

### 3. Asegúrate de tener un `.dockerignore`

Crea el archivo `.dockerignore` en la raíz con este contenido:

```
node_modules
.git
.env
storage/logs/*
storage/framework/cache/*
storage/framework/sessions/*
storage/framework/views/*
public/build
```

### 4. Construye y levanta los contenedores

```bash
docker compose up --build
```

La primera vez tarda unos minutos porque descarga imágenes y compila assets.

### 5. Abre en el navegador

```
http://localhost:8080
```

---

## Comandos útiles

```bash
# Ver logs en tiempo real
docker compose logs -f app

# Entrar al contenedor de la app
docker compose exec app sh

# Correr migraciones manualmente
docker compose exec app php artisan migrate

# Parar todo
docker compose down

# Parar y borrar volúmenes (cuidado: borra la base de datos)
docker compose down -v
```

---

## Para subir a la nube

Una vez que funcione local, el flujo es:

1. **Construir la imagen:**
   ```bash
   docker build -t compured-peru:1.0 .
   ```

2. **Etiquetar y subir a un registry** (Docker Hub, AWS ECR, Google GCR):
   ```bash
   docker tag compured-peru:1.0 tu-usuario/compured-peru:1.0
   docker push tu-usuario/compured-peru:1.0
   ```

3. **Desplegar** en el servicio cloud (AWS ECS, Google Cloud Run, Railway, Render, etc.)

---

## Notas importantes

- El archivo `.env` **nunca** debe subirse a Git. Verifica que está en `.gitignore`.
- En producción en la nube, las variables de entorno se configuran directamente en el panel del servicio cloud, no con un archivo `.env`.
- La base de datos MySQL del `docker-compose.yml` es para desarrollo local. En producción usarás el servicio de base de datos de tu proveedor cloud (RDS, Cloud SQL, etc.).
