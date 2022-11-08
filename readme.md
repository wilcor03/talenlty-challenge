# Talently Challenge

### SOLUCIÓN CHALLENGE

Se implemento la refactorización del código con enfoque a principios S.O.L.I.D de tal manera que un nuevo desarrollador o usuario del mismo, podrá añadir, en adelante de manera sencilla un nuevo producto y sus caracterísrticas relacionadas.

#### ¿COMO FUNCIONA?

Actualmente el sistema permite crear 5 tipos de producto:
1. *normal*
2. *Pisco Peruano*
3. *Tumi de Oro Moche*
4. *Ticket VIP al concierto de Pick Floid*
5. *Café Altocusco*

solo requerirá instanciar la clase *VillaPeruana* y pasar los valores al constructor asi:

    `GildedRose::of('Café Altocusco', 10, 10);`

#### COMO AÑADIR UN NUEVO TIPO DE PRODUCTO

1. Podrá crear una nueva *CLASE* y extenderla de la clase App\ProductClasses\Product
2. implemente los dos métodos de arranque:

    public static function of($name, $quality, $sellIn) {            
        return new static($name, $quality, $sellIn);
    }

    public function __construct($name, $quality, $sellIn){            
        parent::__construct($name, $quality, $sellIn);                  
    }

3. (OPCIONAL): Si su producto no se encuentra dentro del listado especificado anteriormente, puede sobreescribir la propiedad Array publica *$types*:
    public $types = ["Café Altocusco"];

4. (OPCIONAL): si el cálculo de *quality* o de *SellIn* no cumplen con su requerimiento. Puede sobreescribir la propiedad *$quality* o *$sellIn* a través de los metodos setters: 

    public function setQuality($value) {}
    public function setSellIn($value) {}


### Configuraciones adicionales:
Todas las clases incluidads dentro del directorio *ProductClases* cargan de manera dinámica en la clase *App\Providers\ProductProvider*;
si desea modificar el nombre de dicho directorio, deberá configurarlo en el archivo *config/constantes.php* cambiando la constante *PRODUCT_ROOT_FOLDER*

## DEUDA TÉCNICA
el ejercicio se desarrollo a partir de la práctica **TDD**, sin embargo, en el caso del producto *"Tumi"* merciona que el quality es 80 y no debe cambiar; en la prueba unitaria trabaja con valores variables que devuelven el mismo valor y por tanto se trabajo de la misma manera. Una diferencia similar se presenta en el producto *Pisco Peruano*, en el ejercicio menciona que su valor se duplica y triplica respectivamente cuando faltan 10 y 5 días para que el SellIn llegue a cero, al igual que los tickers. Sin embargo, para que la prueba unitaria sea exitosa es necesario darle otro tratamiento.


#RESPUESTAS DE CONOCIMIENTO LARAVEL FRAMEWORK

1. Qué paquete o estrategia utilizarías para levantar un sistema de administración rápidamente? (Autenticación y CRUDs)
R\: En las ultimas versiones de Laravel es una excelente opción *Laravel Jetstream* que nos brinda un sistema de base bastante robusto con miras al desarrollo rápido. *Laravel Breeze* en menor medida pero también nos ofrece un buen punto de partida.

2. Una breve explicación de cómo laravel utiliza la injección de dependencias
R\: Con tal de hacer mucho mas eficientes y mantenibles nuestra aplicaciones, surge la necesidad de crear componentes lo más desacoplados posibles, de tal manera que un cambio, no nos rompa toda la aplicación. Es gracias a la *Inyección de dependencias* que logramos gran parte de este objetivo, *bajo acoplamiento y buena cohesión*. Laravel implementa su *Service Container* justamente para  ayudarnos a *inyectar* bajo distas modalidades, componentes a través de los constructores o los métodos de nuestra aplicación.

3. En qué casos utilizarías un Query Scope?
R\: Un caso puntual en donde uso bastante los query Scopes, es al momento de realizar busquedas a trávés de formularios vía método GET: sencillamente valido si enla url existe el parametro, ejecuto ese *Query scope* para que busque en un campo o campos especificos en ciertos. Es decir, puedo enviar varios campos a buscar a través de la url, pero la consulta solo me arrojará resultados para los campos que no estan vacíos. Si todos los parámetros de la url estan vacios, la consulta me devolverá todos los resultados. $builder->ofName->ofID->paginate(). los uso de manera global, o local, dependiendo el caso.

4. Qué convenciones utilizas en la creación e implementación de migraciones?
R\: Las organizo en directorios según el objetivo que tenga el lote de migraciones (Posts, Categories, etc), Nombres de tablas en prural y en ingles, implemento los softDeletes y timestamps para tener control de cambios en los casos en que sea necesario
las pruebo con los Seeders y los factories. marco como indexables, de manera estratégica, los campos que pueden ser potencialmente buscados manteniendo equilibrio entre rendimiento y espacio de almacenamiento.


# Talently Challenge

## Configuración

Este repositorio incluye la configuración inicial para este problema, incluyendo los specs. Usa la librería de [Kahlan](http://kahlan.readthedocs.org/en/latest/), que probablemente no has usado. Pero no te preocupes, no hay mucho que aprender. Revisa los specs y entenderás la sintaxis básica en menos de un minuto.

Tu tarea es:

1. Refactorizar el código en la clase `VillaPeruana.php`.
2. Agregar un nuevo typo de elemento, "Café". Las especificaciones para este elemento están comentadas en el archivo `VillaPeruanaScpec.php`.

## Flujo

Debes tener instalado docker en tu computadora para usar nuestros comandos del flujo de trabajo

- Usa el comando `./start` para inicializar el docker
- Usa el comando `./test` para correr los tests
- Usa el comando `./finish` para desactivar el docker

# Reglas

Hola y bienvenido al equipo La Villa Peruana. Como sabes, somos una pequeña posada, con una excelente ubicación en una ciudad importante, administrada por nuestra amigable Allison. También compramos y vendemos los más finos productos. Desafortunadamente, nuestros productos se van desgradando constantemente en calidad conforme se acercan a su fecha de vencimiento. Tenemos un sistema que actualiza nuestro inventario por nosotros. Fue desarrollado por un desarrollador llamado Elmo, quien ha ido en busca de nuevas aventuras.

Queremos agregar una nueva categoría de productos al sistema y para ello necesitamos tu ayuda.

Primero, una introducción a nuestro sistema:

- Todos los productos tienen un SellIn que denota el número de días que se tienen para vender el producto
- Todos los productos tienen un Quality que denota cuán valioso es el producto
- Al final de cada día, nuestro sistema disminuye los ambos valores para cada producto

Bastante simple, ¿verdad? Bueno, acá se pone interesante:

- Cuando la fecha de venta ha pasado, el Quality se degrada dos veces más rápido
- El Quality de un producto nunca es negativo
- Los productos "Pisco Peruano", en realidad, incrementan en Quality mientras más viejos están
- El Quality de un producto nunca es mayor a 50
- Los productos "Tumi", siendo un producto legendario, nunca debe ser vendido o bajaría su Quality
- Los "Tickets VIP", así como "Pisco Peruano", incrementan su Quality conforme su SellIn se acerca a 0, el Quality incrementa en 2 cuando faltan 10 días o menos y en 3 cuando faltan 5 días o menos, pero el Quality disminuye a 0 después del concierto.

Recientemente hemos firmado un contrato con un proveedor de productos de "Café". Esto require una actualización para nuestro sistema:

- Los productos de "Café" se degradan en Quality el doble que los productos normales

Para dejarlo claro, un producto nunca puede incrementar su Quality mayor a 50, sin embargo "Tumi" es un producto legendario y como tal su Quality es 80 y nunca cambia.

# Entregable o Expectativa del reto

- La limpieza y legibilidad del código será considerada.
- La eficiencia del código en cuestiones de rendimiento sumarán para esta prueba.
- Será indispensable uso de principios S.O.L.I.D.
- Al finalizar el reto, enviar el enlace de la solución a emmanuel.barturen@talently.tech con copia a cristian@talently.tech con título "Reto Talently Backend"

# Preguntas de conocimiento en Laravel

1. Qué paquete o estrategia utilizarías para levantar un sistema de administración rápidamente? (Autenticación y CRUDs)
2. Una breve explicación de cómo laravel utiliza la injección de dependencias
3. En qué casos utilizarías un Query Scope?
4. Qué convenciones utilizas en la creación e implementación de migraciones?
