## Consejo

<p>Usen storage para almacenar la imagen instalen la librería hashids, guarden la imagen por su número de ID, cuando llamen a la imagen pasen el ID encriptado y lo desencriptar en el controlador (o modelo para los bucles) y así quedará en el front como un archivo encriptado lo cual hará imposible que se descarguen sus imágenes o que usen un servicio rest para escanear su BD en busca de todas las imagenes</p>

## Beneficios
<p>* 1ª de vista al cliente todas las rtutas estan encriptadas, pero de vista al servidor tenemos los nombres de las imagenes tanto en servidor como en base de datos de una forma organica (es decir entendible)p>
<p>* 2ª podemos agrewgar una capa extra de seguridad a los metodos (isAdmin, Auth, o cuaqlquier otra cosa para evitar que usuarios que no deseamos puedan interactuar con las imagenes)</p>
<p>* 3ª podemos controlar el bucle para que devuelva algo en empty y si validamos el metodo getImagen podemos devolver un codigo 401 en la respuesta JSON asi como una imagen por default para ese codigo de error (no lo implemente porque me dio pereza implementar el laravel/ui pero es simple)</p>

## Explicacion
1. Si la base de datos esta vacia:
<img src="https://i.imgur.com/0h3uvSt.png">
2. El bucle manda la respuesta de que no hay imagenes
<img src="https://i.imgur.com/QiQUnHD.png">
3.Subimos una imagen
<img src="https://i.imgur.com/BV6uGab.png">
4. Y se visualizan en el forelse
<img src="https://i.imgur.com/i8l45EU.png">
5. En la BD se guardaron con un nombre Organico 1.jpg (sabemos que esa imagen pertenece al id 1 de la categoria que determinemos):
<img src="https://i.imgur.com/Y9UmzFV.png">
6. En nuestra estructura de direcctorios tambien se crea de forma organica, cuando revisemos nuestros ficheros podemos ver que estan las imagenes sin encriptar
<img src="https://i.imgur.com/9Znogjm.png">
7. A la hora de imprimir la vista si aparecen el archivo encriptado, por ende ya no puede ser atacado por un sistema automatizado a menos que conozcan nuestra clave de HashIds
<img src="https://i.imgur.com/35DBnRu.png">
8. Si alguien intentara acceder manualmente a la ruta se encontraria con el blob asi que no lo podria descargar
<img src="https://i.imgur.com/bAQjjto.png">
9. Si intentara retroceder en la vista de directorios al ser una ruta nos daria un 404
<img src="https://i.imgur.com/pbG42Kn.png">
10. Y al intentar guardar la imagen como solo te dejaria guardar el html por ende no obtendria la imagen
<img src="https://i.imgur.com/74Z6LjZ.png">

Si le hechan ingenio pueden hacer de esto un metodo extraido en el cual les sirva para todas las imagenes de forma automatizada.

Fuente: <a href="https://www.facebook.com/groups/laravelesp/?post_id=3373660762688003">Grupo de Facebook Laravel en Español</a>
