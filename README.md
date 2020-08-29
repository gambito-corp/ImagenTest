## Consejo

<p align="center">Usen storage para almacenar la imagen instalen la librería hashids, guarden la imagen por su número de ID, cuando llamen a la imagen pasen el ID encriptado y lo desencriptar en el controlador (o modelo para los bucles) y así quedará en el front como un archivo encriptado lo cual hará imposible que se descarguen sus imágenes o que usen un servicio rest para escanear su BD en busca de todas las imagenes</p>

## Beneficios
<p>1ª de vista al cliente todas las rtutas estan encriptadas, pero de vista al servidor tenemos los nombres de las imagenes tanto en servidor como en base de datos de una forma organica (es decir entendible)p>
<p>2ª podemos agrewgar una capa extra de seguridad a los metodos (isAdmin, Auth, o cuaqlquier otra cosa para evitar que usuarios que no deseamos puedan interactuar con las imagenes)</p>
<p>3ª podemos controlar el bucle para que devuelva algo en empty y si validamos el metodo getImagen podemos devolver un codigo 401 en la respuesta JSON asi como una imagen por default para ese codigo de error (no lo implemente porque me dio pereza implementar el laravel/ui pero es simple)</p>
