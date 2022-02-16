El sistema de backend sera hecho en php.

Usen el mockdb.php de la carpeta .env/base para obtener una base de datos provisional

Usen el mockdata.php de la carpeta .env/base para obtener algunos datos provisionales

Usen el mockturno.php de la carpeta .env/base para obtener turnos nuevos alrededor de la semana (WIP)

Funcionamientos:
Noticias

url:
ChuPinkAngular/ChuPink-Backend/noticias/public/
y para filtrar se tienen que mandar en el body un json asi:
{
         "pattern":"filtro"
}

Noticias ADMIN

url:
ChuPinkAngular/ChuPink-Backend/noticias/admin/
Method cambia que se hace
PUT = Editar ,documentacion correspondiente: (1)
DELETE = Borrar ,documentacion correspondiente: (2)
GET = Obtener ,documentacion correspondiente: (3)
POST = Subir ,documentacion correspondiente: (4)
(1) INCOMPLETO
(2) Campos marados con * son necesarios
{
         "id":"1" *
}
(3) Campos marados con * son necesarios
{
         "pattern":"filtrado"
}
(4) Campos marados con * son necesarios
{
        "titulo":"Titulo"*
    	"contenido":"Titulo"*
    	"region":"arg/rn/bariloche"*
    	"tags":"UNICA/DESTACADA"
    	"fin_oferta":"2021-11-28 00:09:19" (Formato yyyy-mm-dd hh:mm:ss) Para quedarnos con otro formato subir un request al que maneja el backend a travez de git
    	"servicios":"MANICURA/PEDICURA"*
    	"activa":"1"  default "0"
		"user": "admin"*
}

Ofertas

url:
ChuPinkAngular/ChuPink-Backend/ofertas/public/
y para filtrar se tienen que mandar en el body un json asi:
{
         "pattern":"Manicura"
}

