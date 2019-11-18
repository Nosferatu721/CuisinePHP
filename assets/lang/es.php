<?php

define('idioma', 'INGLES');
define('lang', 'en');
define('color', 'secondary');
define('salir', 'Salir');

// Roles
define('admin', 'Administrador');
define('jefeCocina', 'Jefe de Cocina');
define('jefeZona', 'Jefe de Zona');

// Login
define('titulo', 'Bienvenido a Cuisinesoft');
define('codigo', 'Codigo');
define('pass', 'Contraseña');
define('btnIngresar', 'Ingresar');
define('btnOlvidoPass', 'Olvide Mi Contraseña');

// login Alerts
define('vacios', 'Existen campos vacios');
define('passIncorret', 'Contraseña Incorrecta');
define('notExists', 'El Usuario No Existe');
define('sendEmail', 'Revise su Correo se ha enviado su Contraseña');
define('inactivo', 'El Usuario Esta Inactivado');

// Recuperar Contraseña
define('tituloRecuperarPass', 'Recuperar Contraseña');
define('btnEnviarEmail', 'Enviar');
define('regresar', 'Regresar');

// Menu
define('inicio', 'Inicio');
//
define('restaurantes', 'Restaurantes');
// ------
define('gestionRestaurante', 'Gestionar Restaurantes');
define('registrarUsuario', 'Registrar Usuario');
define('consultUsuarios', 'Consultar Usuarios');
define('gestionCargos', 'Gestionar Cargos');
//
define('productos', 'Productos');
// ------
define('registrarProduct', 'Registrar Producto');
//
define('stock', 'Stock');
// ------
define('consultStock', 'Consultar Stock');
define('registrarStock', 'Registrar Stock');
//
define('merma', 'Merma');
// ------
define('registrarMerma', 'Registrar Merma');
define('consultMerma', 'Consultar Merma');
define('gestionTipoMerma', 'Gestionar Tipos de Merma');
//
define('menaje', 'Menaje');

// Index
define('tituloIndex', 'Bienvenido al Sistema para tu Restaurante');
define('textoIndex1', 'Este Sistema facilitará el control de materias primas, menaje, mermas, alerta de agotamiento del Stock, para el restaurante Andrés Carne de Res.');
define('textoIndex2', 'Cambiando el método de realizar los procesos de forma manual y realizarlos mediante este Sistema de Información.');

// Form General
define('registrar', 'Registrar');
define('actualizar', 'Actualizar');

// Tablas General
define('editar', 'Editar');
define('eliminar', 'Eliminar');
define('activar', 'Activar');
define('estado', 'Estado');
define('inactivar', 'Inactivar');
define('confirmar', 'Confirmar');
define('pregunta', 'el usuario?');
define('acciones', 'Acciones');
define('cancelar', 'Cancelar');
define('nombre', 'Nombre');
define('apellido', 'Apellido');
define('producto', 'Producto');
define('cantidad', 'Cantidad');
define('fecha', 'Fecha');
define('fechaMerma', 'Fecha Merma');
define('motivo', 'Motivo');
define('perdida', 'Perdida');
define('tipoMerma', 'Tipo de Merma');
define('precio', 'Precio');
define('email', 'Correo');
define('contraseña', 'Contraseña');
define('cargo', 'Cargo');
define('restaurante', 'Restaurante');
define('direccion', 'Dirección');
define('tittleTableRestaurante', 'Lista de Restaurantes');
define('tittleTableUsuarios', 'Lista de Usuarios');
define('tittleTableCargos', 'Lista de Cargos');
define('tittleTableTipoMerma', 'Lista de Tipos de Merma');
define('tittleTableProducto', 'Lista de Productos');
define('tittleTableStock', 'Lista de Stock');
define('tittleTableMerma', 'Lista de Merma');
define('generarPDF', 'Generar PDF');

// Restaurante
define('tittleRest', 'Control de Restaurantes');
define('formTittleRest1', 'Nuevo Restaurante');
define('formTittleRest2', 'Editar Restaurante');
define('nombreRestaurante', 'Nombre Restaurante');
define('direccionRestaurante', 'Dirección Restaurante');
// Restaurante Alerts
define('restRegistrado', 'Restaurante Registrado Exitosamente');
define('restEditado', 'Restaurante Editado Exitosamente');
define('restEliminado', 'Restaurante Eliminado Exitosamente');
define('imposibleEliminar', 'No Se Puede Eliminar');

// Usuario
define('tittleUser', 'Usuarios Registrados');
define('tittleRegisUsuario1', 'Registro de Usuarios');
define('tittleRegisUsuario2', 'Editar Usuario');
define('selectCargo', 'Seleccionar Cargo');
define('elija', 'Elija...');
define('selectRestaurante', 'Seleccionar Restaurante');
define('nombreUsuario', 'Nombre');
define('apellidoUsuario', 'Apellido');
define('emailUsuario', 'Correo');
define('passUsuario', 'Contraseña');
define('regisNuevoUsuario', 'Registrar Nuevo Usuario');
define('existUser', 'El Usuario Ya Existe');

// Usuario Alerts
define('userRegistrado', 'Usuario Registrado Exitosamente');
define('userEditado', 'Usuario Editado Exitosamente');
define('userCambiado', 'Usuario Cambiado Exitosamente');

// Cargo
define('tittleCargo', 'Control de Cargos');
define('formTittleCargo1', 'Nuevo Cargo');
define('formTittleCargo2', 'Editar Cargo');
define('nombreCargo', 'Nombre Cargo');
// Cargo Alerts
define('cargoRegistrado', 'Cargo Registrado Exitosamente');
define('cargoEditado', 'Cargo Editado Exitosamente');
define('cargoEliminado', 'Cargo Eliminado Exitosamente');

// Tipo Merma
define('tittleTipoMerma', 'Control de Tipos de Merma');
define('formTittleTipoMerma1', 'Nuevo Tipo de Merma');
define('formTittleTipoMerma2', 'Editar Tipo');
define('nombreTipoMerma', 'Nombre Tipo');
// Tipo Merma Alerts
define('tipoMermaRegistrado', 'Tipo de Merma Registrado Exitosamente');
define('tipoMermaEditado', 'Tipo de Merma Editado Exitosamente');
define('tipoMermaEliminado', 'Tipo de Merma Eliminado Exitosamente');

// Producto
define('tittleProducto', 'Control de Productos');
define('formTittleProducto1', 'Nuevo Producto');
define('formTittleProducto2', 'Editar Producto');
define('nombreProducto', 'Nombre Producto');
define('precioProducto', 'Precio Producto');
// Producto Alerts
define('productoRegistrado', 'Producto Registrado Exitosamente');
define('productoEditado', 'Producto Editado Exitosamente');
define('productoEliminado', 'Producto Eliminado Exitosamente');

// Stock
define('tittleStock', 'Control de Stock');
define('tittleRegisStock1', 'Registro de Stock');
define('tittleRegisStock2', 'Editar Stock');
define('selectProducto', 'Seleccionar Producto');
define('cantidadActualStock', 'Cantidad de Stock Actual = ');
define('addStock', 'Agregar / Disminuir Stock');
define('mensajeCantidad', 'La cantidad sería menor que 0');
define('fechaVenciProducto', 'Fecha Vencimiento');
define('loteStock', 'Lote');
define('regisNuevoStock', 'Registrar Nuevo Stock');
define('existStock', 'El producto ya esta Registrado');
// Stock Alerts
define('stockRegistrado', 'Stock Registrado Exitosamente');
define('stockEditado', 'Stock Editado Exitosamente');
define('stockEliminado', 'Stock Eliminado Exitosamente');

// Merma
define('tittleMerma', 'Control de Merma');
define('tittleRegisMerma1', 'Registro de Merma');
define('tittleRegisMerma2', 'Editar Merma');
define('cantidadActualMerma', 'Cantidad de Merma Actual = ');
define('addMerma', 'Agregar / Disminuir Merma');
define('regisNuevaMerma', 'Registrar Nueva Merma');
// Merma Alerts
define('mermaRegistrado', 'Merma Registrada Exitosamente');
define('mermaEditado', 'Merma Editada Exitosamente');
define('mermaEliminado', 'Merma Eliminada Exitosamente');


// Correo
define('Mensaje', 'Correo en Español');



// PDF
define('creadoPor', 'Creado Por');
define('reporte', 'Reporte');
define('activado', 'Activo');
define('inactivado', 'Inactivo');
define('generado', 'Generado');

//Variables Ventas
define('regisVen','Registrar Venta');
define('newSale', 'Nueva Venta');
define('sales', 'Control Ventas');
define('saleRegis', 'Venta Registrada Exitosamente');
define('saleList', 'Lista de Ventas');
define('saleDate', 'Fecha Venta');
define('saleAction', 'Acciones');
define('saleView', 'Ver');
define('sale', 'Venta');
define('prodVen', 'Producto En Venta Registrado Exitosamente');
define('prodVen1', 'Producto En Venta Editado Exitosamente');
define('prodVen2', 'Producto En Venta Eliminado Exitosamente');
define('prodVen3', 'No Se Puede Eliminar');
define('prodVen4', 'Existen Campos Vacios');
define('saleId', 'Id Venta');
define('canSale', 'Cantidad Vendida');
define('prod', 'Producto');
define('proyDate', 'Fecha Proyectada');
define('proyAmount', 'Cantidad Proyectada');
define('prodSale', 'Productos de la Venta');
define('conSale', 'Consultar Ventas');
define('otro', 'Otros');
define('addSale', 'Agregar a la Venta');
define('prodven','Productos Vendidos');


//Variables Pedido
define('pedido', 'Pedido');
define('viewOrd', 'Consultar Pedidos');
define('controlped', 'Control Pedidos');
define('nuevoped', 'Nuevo Pedido');
define('listped', 'Lista Pedidos');
define('idped', ' ID Pedido');
define('fechaped', 'Fecha Pedido');
define('crearped', 'Crear Pedido');
define('newprodped', 'Agregar Producto al Pedido');
define('addPed', 'Agregar Al Pedido');
define('proped', 'Productos En Pedido');

//TODO: Archivos
define('subir', 'Subir Archivos');
define('controlfile', 'Control De Archivos');
define('fileup', 'Archivo Subido.');
define('filedel', 'Archivo Eliminado.');
define('nodel', 'No lo puede eliminar.');
define('filerep', 'El archivo ya se encuentra registrado.');
define('noext', 'El tipo de archivo no se puede usar.');
define('selectfile', 'Seleccione el Archivo');
define('listfile', 'Lista de Archivos');
define('descr', 'Descripcion del Archivo');
define('subidopor', 'Subido Por');
define('filename', 'Nombre Archivo');

//Texto pagina principal
define('text1','Lo que comenzó con unas pocas mesas, fabricadas por él mismo con sus dotes de
            carpintero, un letrero hecho a mano, un sol, una luna, y una estrella, se comvirtió poco a poco, con
            empuje,
            talento y verraquera, en un universo que brillo y da calor con su propio fuego.');
define('especial','Especiales del Mes');
define('espec1','Cerdo Agridulce');
define('espec2','Ceviche');

//PDF var
define('fechai','Fecha Inicial');
define('fechaf','Fecha Final');
define('prodpdf','Productos En El Restaurante');
define('stockpdf','Stock Del Restaurante');
define('prodvenpdf','Productos Vendidos');
define('proyvsprod','Productos VS Proyeccion');
define('proy','Proyeccion');
