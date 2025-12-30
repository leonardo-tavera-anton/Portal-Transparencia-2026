# 🔐 Sistema de Control de Acceso de Usuarios

## Funcionalidad de Activación/Desactivación de Usuarios

### ✅ Características Implementadas

#### 1. **Campo `activo` en la Base de Datos**
- Cada usuario tiene un campo booleano `activo` (true/false)
- Por defecto, todos los usuarios nuevos se crean como **activos**

#### 2. **Control desde el Panel de Administración**
Ruta: `/admin/usuarios`

**Opciones disponibles:**
- ✏️ **Editar**: Cambiar nombre de usuario y contraseña
- ✅ **Activar**: Habilitar acceso al usuario desactivado
- 🚫 **Desactivar**: Bloquear acceso al usuario inmediatamente

#### 3. **Protecciones de Seguridad**

##### No puedes desactivar tu propia cuenta
- El sistema detecta si estás intentando desactivar tu propia sesión
- Muestra "(Tu cuenta)" en lugar del botón de desactivar
- Previene que te quedes sin acceso al sistema

##### Confirmación antes de desactivar
- Aparece un diálogo de confirmación JavaScript
- Advierte que el usuario será expulsado si tiene sesión activa
- Evita desactivaciones accidentales

##### Expulsión automática
- Cuando desactivas un usuario, si tiene una sesión activa:
  - **Se cierra su sesión inmediatamente**
  - **Se limpia toda su información de sesión**
  - **Es redirigido al login** con mensaje de error
  - No puede acceder a ninguna página del admin

#### 4. **Validación en Cada Petición**
El middleware `AdminAuth` verifica en **cada petición**:
1. ¿Está logueado? → Si no, redirige al login
2. ¿Existe el usuario? → Si no, cierra sesión
3. **¿Está activo?** → Si no, expulsa y cierra sesión

### 🎯 Casos de Uso

#### Escenario 1: Desactivar usuario que está conectado
```
1. Usuario "juan" está trabajando en el sistema
2. Admin desactiva a "juan" desde /admin/usuarios
3. "juan" intenta hacer cualquier acción
4. Sistema detecta que está desactivado
5. Cierra su sesión automáticamente
6. Lo redirige al login con mensaje: "Su cuenta ha sido desactivada"
```

#### Escenario 2: Usuario desactivado intenta entrar
```
1. Usuario "maria" está desactivada
2. Intenta hacer login
3. Sistema valida credenciales correctas
4. Pero detecta que activo = false
5. Rechaza el login con mensaje: "Su cuenta está desactivada"
```

#### Escenario 3: Reactivar usuario
```
1. Admin va a /admin/usuarios
2. Ve que "pedro" tiene estado "Inactivo"
3. Hace clic en "✅ Activar"
4. El usuario "pedro" puede volver a entrar al sistema
```

### 📋 Estados Visuales

| Estado | Badge | Botón Disponible |
|--------|-------|------------------|
| Activo | 🟢 Badge Verde "Activo" | 🚫 Desactivar |
| Inactivo | 🔴 Badge Rojo "Inactivo" | ✅ Activar |

### 🔄 Flujo Técnico

1. **Login** (`AuthController::login`)
   - Valida credenciales
   - **Verifica campo `activo`**
   - Solo permite login si `activo = true`

2. **Middleware** (`AdminAuth`)
   - Se ejecuta en cada petición
   - Consulta estado actual del usuario
   - **Expulsa si `activo = false`**

3. **Toggle** (`UsuarioController::toggleStatus`)
   - Cambia el valor de `activo`
   - No puede desactivar al usuario logueado
   - Guarda cambio en base de datos

### 💾 Base de Datos

```sql
-- Campo en tabla usuarios
activo BOOLEAN DEFAULT true
```

### 🛡️ Seguridad Implementada

✅ Validación en login  
✅ Validación en cada petición (middleware)  
✅ Protección contra auto-desactivación  
✅ Confirmación de JavaScript  
✅ Limpieza completa de sesión  
✅ Mensajes claros al usuario  

### 🎨 Interfaz Visual

- **Botones contextuales**: Cambian de color según la acción (rojo/verde)
- **Badges informativos**: Muestran estado actual claramente
- **Confirmación amigable**: Diálogo antes de cambiar estado
- **Feedback inmediato**: Mensajes de éxito al cambiar estado

---

## 📝 Notas Importantes

1. **No puedes desactivar tu propia cuenta** - Protección incluida
2. **Los usuarios desactivados son expulsados inmediatamente** - No necesitan cerrar sesión
3. **Las credenciales siguen siendo válidas** - Solo cambia el estado de acceso
4. **Puedes reactivar en cualquier momento** - El proceso es reversible

---

**Usuario Admin por Defecto:**
- Username: `admin`
- Password: `admin123`
- Estado: Activo

**Gestión:** http://127.0.0.1:8000/admin/usuarios
