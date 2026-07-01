<?php

/**
 * Datos de la empresa que se muestran en la boleta electrónica.
 * ⚠️ EDITA ESTOS VALORES con los datos reales de Compured Perú.
 * No hace falta tocar ningún otro archivo: la boleta los toma de aquí.
 */

return [

    'nombre'          => 'COMPURED PERÚ S.A.C.',
    'ruc'             => '20000000000',
    'direccion'       => 'Av. Ejemplo 123, San Isidro - Lima - Perú',
    'telefono'        => '(01) 000 0000',
    'celular'         => '999 999 999',
    'correo'          => 'ventas@compured.pe',
    'web'             => 'https://compured.pe',

    // Ruta relativa dentro de /public. Cambia el archivo en public/img/logo.png
    // por el logo real si aún no lo está.
    'logo'            => 'img/logo.png',

    // Color principal de la boleta (franja/encabezado). Usa el que prefieras.
    'color_primario'  => '#0f766e',

    // Series de comprobante. Si Compured usa otras series reales, cámbialas aquí.
    'serie_boleta'    => 'B001',
    'serie_factura'   => 'F001',

    // true  => el precio que se cobra YA incluye el IGV (18%), y en la boleta
    //          se desglosa Op. Gravada + IGV a partir del total.
    // false => el total NO incluye IGV, y se le suma el 18% aparte.
    'incluye_igv'     => true,

];
