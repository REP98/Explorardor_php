# Explorardor_php
Controlador laravel para explorar archivos y permitir la buscquedad de los archivos por sus nombres, fecha y/o extencion.

* Autor: Robert Pérez
* Email: delfinmundo@gmail.com
* Licencia: [MIT](LICENCE)
* Site web: https://svilupporep.site

## Uso
Es muy facil de usar se instala, e usa.

## Instalar

* Descargar el archivo Exploraodr php
* Coloca el archivo en la carpeta /mi_proyecto/app/Http/Controllers/
Listo

## USO
Una vez instalado solo lo invocamos

```php
use App\Http\Controllers\Explorer;

$e = new Explorer(
  'name' // Nombre del archivo a buscar, puede ser un nombre, DNI, número entre otros (Obligatorio)
  'ext' // extencion del archivo a buscar, puede ser un array de extenciones o use el "*" para traer todo
  'dir' // Carpeta donde buscar, por defecto busca en la carpeta public/upload
  'opt' // Array con la fecha a buscar en el formato dado.
);
echo json_encode($e->files); // Salida de Resultados
```

### Parametros y retornos

Como hemos mencionado solo cuenta con 4 parametos y uno solo obligatorio, el nombre del archivo a buscar las extenciones pueden ser pasadas como un string `*` o como un array `[jpg,pdf,html]` en caso de la carpeta debemos pasar la ruta de la carpeta donde se encuentran los archivos a usar para la busquedad y por ultimo el parametro opción es una array donde se añade la fecha `["fecha"=>"0320"]`.

```php
//Buscamos la foto de un USUARIO por DNI en el mes de junio del presente año, dicho archivo esta asi dni_mesaño.extención
$e = new Explorer(
  '18902345'
  ['jpg','png','jpeg']
  '/public/profile/'
  ['fecha'=>'0520']
);
var_dump($e->files);
//Esto devolvera una matris 
/*
[
  'dir'=>[],
  'file'=>[
   '18902345_0520'
  ]
]
*/
```
