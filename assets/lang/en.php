<?php

define('idioma', 'SPANISH');
define('lang', 'es');
define('color', 'secondary');
define('salir', 'Logout');

// Roles
define('admin', 'Administrator');
define('jefeCocina', 'Chef');
define('jefeZona', 'Zone leader');

// Login
define('titulo', 'Welcome To Cuisinesoft');
define('codigo', 'Code');
define('pass', 'Password');
define('btnIngresar', 'Login');
define('btnOlvidoPass', 'Forgot Password?');

// login Alerts
define('vacios', 'There is empty fields');
define('passIncorret', 'Wrong Password');
define('notExists', 'User already exist');
define('sendEmail', 'The password was send to your E-Mail');
define('inactivo', 'Your user is inactivated');

// Recuperar Contraseña
define('tituloRecuperarPass', 'Recover Password');
define('btnEnviarEmail', 'Send');
define('regresar', 'Back');

// Menu
define('inicio', 'Home');
//
define('restaurantes', 'Restaurants');
// ------
define('gestionRestaurante', 'Manage Restaurants');
define('registrarUsuario', 'Create User');
define('consultUsuarios', 'Consult Users');
define('gestionCargos', 'Manage Positions');
//
define('productos', 'Products');
// ------
define('registrarProduct', 'Create Product');
//
define('stock', 'Stock');
// ------
define('consultStock', 'Consult Stock');
define('registrarStock', 'Create Stock');
//
define('merma', 'Waste or Trim');
// ------
define('registrarMerma', 'Create Waste or Trim');
define('consultMerma', 'Consult Waste or Trim');
define('gestionTipoMerma', 'Manage Waste or Trim Types');
//
define('menaje', 'Kitchenware');


// Index
define('tituloIndex', 'Welcome to the information system for your restaurant');
define('textoIndex1', 'This web development will ease the control on raw products, kitchenware,Waste or Trim for the bussiness Andres Carne de Res Express.');
define('textoIndex2', 'Changing the manual way of develop their process and make an automatitation with this information system.');

// Form General
define('registrar', 'Create');
define('actualizar', 'Update');

// Tablas General
define('editar', 'Edit');
define('eliminar', 'Delete');
define('activar', 'Activate');
define('estado', 'State');
define('inactivar', 'Deactivate');
define('confirmar', 'Confirm');
define('pregunta', 'user?');
define('acciones', 'Actions');
define('cancelar', 'Cancel');
define('nombre', 'Name');
define('apellido', 'Lastname');
define('producto', 'Product');
define('cantidad', 'Amount');
define('fecha', 'Date');
define('fechaMerma', 'Date of Waste or Trim');
define('motivo', 'Cause');
define('perdida', 'Loss');
define('tipoMerma', 'Type of Waste or Trim');
define('precio', 'Price');
define('email', 'E-mail');
define('contraseña', 'Password');
define('cargo', 'Positions');
define('restaurante', 'Restaurant');
define('direccion', 'Address');
define('tittleTableRestaurante', 'List of Restaurants');
define('tittleTableUsuarios', 'Lista of Users');
define('tittleTableCargos', 'List Of Positions');
define('tittleTableTipoMerma', 'List Type of Waste or Trim');
define('tittleTableProducto', 'List of Products');
define('tittleTableStock', 'List Stock');
define('tittleTableMerma', 'List of Waste or Trim');
define('generarPDF', 'Create PDF');

// Restaurante
define('tittleRest', 'Control of Restaurant');
define('formTittleRest1', 'Create Restaurant');
define('formTittleRest2', 'Edit Restaurant');
define('nombreRestaurante', 'Name Restaurant');
define('direccionRestaurante',  'Restaurant Address');
// Restaurante Alerts
define('restRegistrado', 'New Restaurant Created Successfully');
define('restEditado', 'Restaurant Edited Successfully');
define('restEliminado', 'Restaurant Deleted Successfully');
define('imposibleEliminar', 'Can not delete.');

// Usuario
define('tittleUser', 'Create Users');
define('tittleRegisUsuario1', 'User Registration');
define('tittleRegisUsuario2', 'Edit User');
define('selectCargo', 'Select Position');
define('elija', 'Choose...');
define('selectRestaurante', 'Restaurant Selection');
define('nombreUsuario', 'Name');
define('apellidoUsuario', 'Lastname');
define('emailUsuario', 'E-mail');
define('passUsuario', 'Password');
define('regisNuevoUsuario', 'Create New User');
define('existUser', 'User already on database.');

// Usuario Alerts
define('userRegistrado', 'User Created Successfully');
define('userEditado', 'User Edited Successfully');
define('userCambiado', 'User Update Successfully');

// Cargo
define('tittleCargo', 'Manage Positions');
define('formTittleCargo1', 'New Position');
define('formTittleCargo2', 'Edit Position');
define('nombreCargo', 'Position Name');
// Cargo Alerts
define('cargoRegistrado', 'Position Created Successfully');
define('cargoEditado', 'Position Edited Successfully');
define('cargoEliminado', 'Position Deleted Successfully');

// Tipo Merma
define('tittleTipoMerma', 'Type Waste or Trim Management');
define('formTittleTipoMerma1', 'New Type Waste or Trim');
define('formTittleTipoMerma2', 'Edit Type');
define('nombreTipoMerma', 'Name Type');
// Tipo Merma Alerts
define('tipoMermaRegistrado', 'Type of Waste or Trim Created Successfully.');
define('tipoMermaEditado', 'Type of Waste or Trim Edited Successfully.');
define('tipoMermaEliminado', 'Type of Waste or Trim Deleted Successfully.');

// Producto
define('tittleProducto', 'Product Management');
define('formTittleProducto1', 'New Product');
define('formTittleProducto2', 'Edit Product');
define('nombreProducto', 'Product Name');
define('precioProducto', 'Product Price');
// Producto Alerts
define('productoRegistrado', 'Product Created Successfully');
define('productoEditado', 'Product Edited Successfully');
define('productoEliminado', 'Product Deleted Successfully');

// Stock
define('tittleStock', 'Stock Management');
define('tittleRegisStock1', 'Create Stock ');
define('tittleRegisStock2', 'Edit Stock');
define('selectProducto', 'Select Product');
define('cantidadActualStock', 'Actual Stock Amount = ');
define('addStock', 'Add / Remove from Stock');
define('mensajeCantidad', 'The amount will be lesser than 0');
define('fechaVenciProducto', 'Expiration Date');
define('loteStock', 'Batch');
define('regisNuevoStock', 'Create New Stock');
define('existStock', 'The Product is already Created');
// Stock Alerts
define('stockRegistrado', 'Stock Created Successfully');
define('stockEditado', 'Stock Edited Successfully');
define('stockEliminado', 'Stock Deleted Successfully');

// Merma
define('tittleMerma', 'Waste or Trim Management');
define('tittleRegisMerma1', 'Create Waste or Trim');
define('tittleRegisMerma2', 'Edit Waste or Trim');
define('cantidadActualMerma', 'Actual Waste or Trim Amount = ');
define('addMerma', 'Add / Diminish Waste or Trim');
define('regisNuevaMerma', 'Create New Waste or Trim');
// Merma Alerts
define('mermaRegistrado', 'Waste or Trim Created Successfully');
define('mermaEditado', 'Waste or Trim Edited Successfully');
define('mermaEliminado', 'Waste or Trim Deleted Successfully');


// Correo
define('Mensaje', 'Correo en Inglesh');



// PDF
define('creadoPor', 'Created by');
define('reporte', 'Report');
define('activado', 'Active');
define('inactivado', 'Inactive');
define('generado', 'Generated');

//TODO: variables venta Traduccion.
define('regisVen', 'Create Sale');
define('newSale', 'New Sale');
define('sales', 'Sale Control');
define('saleRegis', 'Sale created sucessfully');
define('saleList', 'Sale List');
define('saleDate', 'Sale Date');
define('saleAction', 'Action');
define('saleView', 'Consult');
define('sale', 'Sales');
define('prodVen', 'Product On Sales Added Sucessfully!');
define('prodVen1', 'Product On Sales Edited Sucessfully!');
define('prodVen2', 'Product On Sales Deleted Sucessfully!');
define('prodVen3', 'Can not Be Deleted!');
define('prodVen4', 'There is Empty Fields');
define('saleId', 'Sale ID');
define('canSale', 'Sold Amount');
define('prod', 'Product');
define('proyDate', 'Date Projection');
define('proyAmount', 'Amount Projected');
define('prodSale', 'Sale Products');
define('conSale', 'View Sales');
define('otro', 'Other');
define('addSale', 'Add To Sale');
define('prodven', 'Sold Products');




//Variables Pedido
define('pedido', 'Orders');
define('viewOrd', 'View Orders');
define('controlped', 'Orders Control');
define('nuevoped', 'New Order');
define('listped', 'Orders List');
define('idped', 'Order ID');
define('fechaped', 'Order Date');
define('crearped', 'Create Order');
define('newprodped', 'Add New Product To Order');
define('addPed', 'Add To Order');
define('proped', 'Products On Order');

//Archivos
define('subir', 'Upload Files');
define('controlfile', 'File Control');
define('fileup', 'File Uploaded.');
define('filedel', 'File Deleted.');
define('nodel', 'File can\'t be deleted.');
define('filerep', 'File already uploaded.');
define('noext', 'Review file extension.');
define('selectfile', 'Browse File');
define('listfile', 'File List');
define('descr', 'File Description');
define('subidopor', 'Uploaded By');
define('filename', 'Filename');
//Texto pagina principal
define('text1','What started in a few tables made by himself with his carpenter skills, a handmade sign, the sun, the mooon, and a star,it became little by little with initiative
            ,
            talent and strenght, in an universe that shines and give warm with own fire.');
define('especial','Month Specials');
define('espec1','Sweet And Sour Pork');
define('espec2','Ceviche');


//PDF var
define('fechai','Start Date');
define('fechaf','End Date');
define('prodpdf','Products On Stock');
define('stockpdf','Restaurant Stock');
define('prodvenpdf','Sold Products');
define('proyvsprod','Products VS Proyection');
define('proy','Projection');
//Modal y cambio contrasena
define('actualPass', 'Actual Password');
define('newPass', 'New Password');
define('confPass', 'Confirm Password');
define('change', 'Change');
define('changePass', 'Change Password');
//Almuerzo
define('consultarAlmuerzo','Employee Lunch View');
define('almuerzoPersonal','Employee Lunch');
define('controlAlmuerzo','Lunch Management');
define('crearAlmuerzo', 'Create Employee Lunch');
define('cantidadPersonas','Number Of Employee');
define('listaAlmuerzo','Lunch List');
define('fechaAlmuerzo','Lunch Date');
define('almuerzoId','Lunch Id');
define('addLunch','Add to Lunch');
define('cantidadIndividual','Amount Per Employee');
define('precioTotal','Total Cost');
