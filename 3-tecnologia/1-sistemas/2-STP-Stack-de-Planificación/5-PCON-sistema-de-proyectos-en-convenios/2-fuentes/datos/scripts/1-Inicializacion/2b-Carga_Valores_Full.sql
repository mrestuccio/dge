INSERT INTO proveedor (no_proveedor, fl_cuit, fl_estatuto, fl_dni, fl_poder, fl_sipro, fl_cert_fiscal, fl_cbu, flg_cv, ds_observaciones) VALUES
('Agustin Colli',                  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, NULL),
('Av System',                      NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, NULL),
('Bals',                           TRUE,  TRUE,  TRUE,  TRUE,  NULL,  TRUE,  TRUE,  NULL, NULL),
('Esteban Luhuerta',               NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, NULL),
('Grupo Sur ',                     TRUE,  NULL,  TRUE,  NULL,  NULL, FALSE,  TRUE,  NULL, 'Cert. Fiscal en tr�mite'),
('La Otra vuelta',                 NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, NULL),
('Miguel Sacomano (m�s Sonidos)',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, NULL),
('Pizarro',                        TRUE,  NULL,  TRUE,  NULL,  NULL,  TRUE,  TRUE, FALSE, 'CV DEVENGADO'),
('Rentek',                        FALSE, FALSE, FALSE, FALSE,  NULL, FALSE, FALSE, FALSE, NULL),
('Silverstein',                    TRUE,  NULL,  TRUE,  TRUE,  NULL,  TRUE,  TRUE,  TRUE, NULL),
('Tecba',                         FALSE, FALSE, FALSE, FALSE,  NULL, FALSE, FALSE, FALSE, NULL),
('Tecnical Group',                 NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, NULL),
('Troy',                           NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, NULL);

INSERT INTO proyecto (id_convenio, nu_proyecto, id_area_requirente, id_lugar, id_tipo_proyecto, no_proyecto, va_monto_proyecto, tx_cronograma, fl_estado, ds_observaciones) VALUES
(1,  1,    5, 1,  5, 'MUESTRA BORGES',                                                   3622000,     '50 / 40 / 10',  TRUE, 'Pago anticipo ok. Ver reasignaci�n'),
(1,  2,    1, 1,  7, 'LA NOCHE DE LA FILOSOFIA',                                         4993301,          '90 / 10',  TRUE, 'Pago anticipo ok. Ver reasignaci�n'),
(1,  3,    4, 2, 12, 'CREADORES',                                                       42735000,     '50 / 40 / 10',  TRUE, NULL),
(1,  4,    1, 1,  7, 'COPI',                                                              883600,     '50 / 40 / 10', FALSE, 'Faltan actas de UNTREF para expediente de pago'),
(1,  5,    1, 1,  7, 'JORIS LACOSTE',                                                    1380000,     '50 / 40 / 10', FALSE, 'Faltan actas de UNTREF para expediente de pago'),
(1,  6,    3, 3,  1, 'EL PAIS EN ESCENA',                                                3375000,     '50 / 40 / 10', FALSE, 'Faltan actas de UNTREF para expediente de pago'),
(1,  7,    3, 3,  1, 'EL LABERINTO DE BORGES (acequia)',                                  767500,     '50 / 40 / 10', FALSE, 'Faltan actas de UNTREF para expediente de pago. Ver copia de requerimiento (tenemos la copia con remito)'),
(1,  8,    5, 2, 12, 'PARQUE LABERINTOS',                                               13463200,     '50 / 40 / 10', FALSE, 'Falta proyecto de UNTREF con nuevo monto. Refacturar. VOLVER A CHEQUEAR MONTO CON URTIAGA, PARECE QUE HAY ADICIONALES QUE NO TENEMOS'),
(1,  9,    2, 2,  6, 'SERVICIOS DE PRODUCCI�N - TECN�POLIS 2016 (T�CNICA Y ART�STICA)', 65825000, 'ANTICIPO DEL 70%', FALSE, 'Faltan actas de UNTREF para expediente de pago'),
(1, 10,    5, 2, 12, 'LA RECICLERIA',                                                    6178500,     '50 / 40 / 10', FALSE, 'Faltan actas de UNTREF para expediente de pago'),
(1, 11,    5, 2, 12, 'MUESTRA TECNOLOGICA',                                               764000,     '50 / 40 / 10', FALSE, 'Tramitando firmas de requerimiento, proyecto y aprobaci�n'),
(1, 12,    2, 2, 12, 'NEUROCIENCIA',                                                     8506023,     '50 / 40 / 10', FALSE, 'Sergio mand� a validarlo con Cuevas. Gestionar firmas de notas de Ricardes y del proyecto cuando est� ok.'),
(1, 13,    2, 2, 10, 'EL COLOSO',                                                         220000,     '50 / 40 / 10', FALSE, 'Comparten mismo requerimiento y aprobaci�n. Faltan actas de UNTREF. Esperando validaci�n de �ltima versi�n de Sergio para mandar a la firma de UNTREF (Espacios verdes)'),
(1, 14,    2, 2, 10, 'EL PATITO AMARILLO E INDUSTRIA ARGENTINA',                          220200,     '50 / 40 / 10', FALSE, 'Comparten mismo requerimiento y aprobaci�n. Faltan actas de UNTREF. Esperando validaci�n de �ltima versi�n de Sergio para mandar a la firma de UNTREF (Espacios verdes)'),
(1, 15,    2, 2, 11, 'ESPACIOS VERDES',                                                  2140000,     '50 / 40 / 10', FALSE, 'Comparten mismo requerimiento y aprobaci�n. Faltan actas de UNTREF. Esperando validaci�n de �ltima versi�n de Sergio para mandar a la firma de UNTREF (Espacios verdes)'),
(1, 16, NULL, 2,  8, 'EL LIBERTADOR Y LOS HOMBRES DE LA INDEPENDENCIA',                  2254000,     '50 / 40 / 10',  NULL, 'Terminar con desglose prespuestario'),
(1, 17, NULL, 2,  8, 'EL MUNDO DE LA LUNA - TEATRINO DE MARIONETAS',                     1047000,     '50 / 40 / 10',  NULL, 'Terminar con desglose prespuestario'),
(1, 18,    5, 1,  4, 'BICENTENARIO',                                                        NULL,               NULL,  NULL, 'Esperando documentaci�n'),
(1, 19,    2, 2,  6, 'ASISTENCIAS TECNICAS',                                                NULL,               NULL,  NULL, 'Ver documentaci�n existente'),
(1, 20,    2, 2, 12, 'FISICA Y CIRCO',                                                      NULL,               NULL,  NULL, 'Esperando documentaci�n'),
(1, 22,    2, 2,  2, 'PRODUCCION INTEGRAL',                                                 NULL,               NULL,  NULL, 'Esperando documentaci�n'),
(1, 23,    2, 2,  3, 'PRODUCCION INTEGRAL',                                                 NULL,               NULL,  NULL, 'Esperando documentaci�n'),
(1, 24,    2, 2, 11, 'ANCHO DE BANDA',                                                      NULL,               NULL,  NULL, 'Esperando documentaci�n'),
(1, 25,    2, 2, 11, 'ELEVACION POTENCIA ELECTRICA',                                        NULL,               NULL,  NULL, 'Esperando documentaci�n'),
(1, 26,    2, 2, 13, 'NEUROPARQUE',                                                      1275942,               NULL,  NULL, 'Esperando documentaci�n'),
(1, 27,    2, 2, 12, 'RETRATOS VERBALES: DISCRIMINACI�N Y PREJUICIO',                    2229815,     '50 / 40 / 10',  NULL, 'Sergio mand� a validarlo con Cuevas. Gestionar firmas de notas de Ricardes y del proyecto cuando est� ok.'),
(1, 28,    2, 2,  1, '40 A�OS EN 4 MINUTOS',                                              600000,     '50 / 40 / 10',  NULL, 'Ok. Est� validado por Cuevas. Gestionar firmas'),
(1, 29,    2, 2,  4, 'UN PUEBLO MIL IM�GENES',                                              NULL,     '50 / 40 / 10',  NULL, 'Terminando presupuesto con Sergio para agregar al proyecto. Gestionar firmas'),
(1, 31,    5, 4,  9, 'FOMENTO ARTISTAS RECONOCIDOS EN EL EXTERIOR',                         NULL,               NULL,  NULL, 'Esperando documentaci�n'),
(1, 32,    5, 1,  9, 'DOCUMENTAL COMPLEMENTARIO NOCHE DE LA FILOSOFIA',                     NULL,               NULL,  NULL, 'Esperando documentaci�n');

INSERT INTO factura (id_proyecto, nu_factura, fe_factura, nu_cuota, fl_estado_factura, va_factura) VALUES
( 1, NULL, NULL, 1,  TRUE,  1811000),
( 2, NULL, NULL, 1,  TRUE,  4493971),
( 3, NULL, NULL, 1,  TRUE, 21367500),
( 4, NULL, NULL, 1,  TRUE,   441800),
( 5, NULL, NULL, 1,  TRUE,   690000),
( 6, NULL, NULL, 1,  TRUE,  1687500),
( 7, NULL, NULL, 1,  TRUE,   383750),
( 8, NULL, NULL, 1, FALSE,  6731600),
( 9, NULL, NULL, 1,  TRUE, 46077500),
(10, NULL, NULL, 1,  TRUE,  3089250),
(11, NULL, NULL, 1, FALSE,   382000),
(12, NULL, NULL, 1, FALSE,  4253012),
(13, NULL, NULL, 1,  TRUE,   110000),
(14, NULL, NULL, 1,  TRUE,   110100),
(15, NULL, NULL, 1,  NULL,  1070000),
(16, NULL, NULL, 1,  NULL,  1127000),
(17, NULL, NULL, 1,  NULL,   523500),
(25, NULL, NULL, 1,  NULL,   637971),
(26, NULL, NULL, 1,  NULL,  1114908),
(27, NULL, NULL, 1,  NULL,   300000);

INSERT INTO documento (no_documento, id_proyecto, id_tipo_documento, fl_estado, fi_archivo) VALUES
('ACTA',  1, 1,  TRUE, NULL),
('ACTA',  2, 1,  TRUE, NULL),
('ACTA',  3, 1,  TRUE, NULL),
('ACTA',  4, 1,  TRUE, NULL),
('ACTA',  5, 1,  TRUE, NULL),
('ACTA',  6, 1,  TRUE, NULL),
('ACTA',  7, 1,  TRUE, NULL),
('ACTA',  8, 1,  TRUE, NULL),
('ACTA',  9, 1,  TRUE, NULL),
('ACTA', 10, 1,  TRUE, NULL),
('ACTA', 11, 1, FALSE, NULL),
('ACTA', 12, 1, FALSE, NULL),
('ACTA', 13, 1,  TRUE, NULL),
('ACTA', 14, 1,  TRUE, NULL),
('ACTA', 15, 1,  TRUE, NULL),
('ACTA', 16, 1, FALSE, NULL),
('ACTA', 17, 1, FALSE, NULL),
('ACTA', 27, 1, FALSE, NULL);

INSERT INTO documento (no_documento, id_proyecto, id_tipo_documento, fl_estado, fi_archivo) VALUES
('REQUERIMIENTO',  1, 2,  TRUE, NULL),
('REQUERIMIENTO',  2, 2,  TRUE, NULL),
('REQUERIMIENTO',  3, 2,  TRUE, NULL),
('REQUERIMIENTO',  4, 2,  TRUE, NULL),
('REQUERIMIENTO',  5, 2,  TRUE, NULL),
('REQUERIMIENTO',  6, 2,  TRUE, NULL),
('REQUERIMIENTO',  7, 2,  TRUE, NULL),
('REQUERIMIENTO',  8, 2,  TRUE, NULL),
('REQUERIMIENTO',  9, 2,  TRUE, NULL),
('REQUERIMIENTO', 10, 2,  TRUE, NULL),
('REQUERIMIENTO', 11, 2, FALSE, NULL),
('REQUERIMIENTO', 12, 2, FALSE, NULL),
('REQUERIMIENTO', 13, 2,  TRUE, NULL),
('REQUERIMIENTO', 14, 2,  TRUE, NULL),
('REQUERIMIENTO', 15, 2,  TRUE, NULL),
('REQUERIMIENTO', 27, 2, FALSE, NULL);

INSERT INTO documento (no_documento, id_proyecto, id_tipo_documento, fl_estado, fi_archivo) VALUES
('APROBACI�N',  1, 3,  TRUE, NULL),
('APROBACI�N',  2, 3,  TRUE, NULL),
('APROBACI�N',  3, 3,  TRUE, NULL),
('APROBACI�N',  4, 3,  TRUE, NULL),
('APROBACI�N',  5, 3,  TRUE, NULL),
('APROBACI�N',  6, 3,  TRUE, NULL),
('APROBACI�N',  7, 3,  TRUE, NULL),
('APROBACI�N',  8, 3,  TRUE, NULL),
('APROBACI�N',  9, 3,  TRUE, NULL),
('APROBACI�N', 10, 3,  TRUE, NULL),
('APROBACI�N', 11, 3, FALSE, NULL),
('APROBACI�N', 12, 3, FALSE, NULL),
('APROBACI�N', 13, 3,  TRUE, NULL),
('APROBACI�N', 14, 3,  TRUE, NULL),
('APROBACI�N', 15, 3,  TRUE, NULL),
('APROBACI�N', 27, 3, FALSE, NULL);

INSERT INTO documento (no_documento, id_proyecto, id_tipo_documento, fl_estado, fi_archivo) VALUES
('PROYECTO UNTREF',  1, 4,  TRUE, NULL),
('PROYECTO UNTREF',  2, 4,  TRUE, NULL),
('PROYECTO UNTREF',  3, 4,  TRUE, NULL),
('PROYECTO UNTREF',  4, 4,  TRUE, NULL),
('PROYECTO UNTREF',  5, 4,  TRUE, NULL),
('PROYECTO UNTREF',  6, 4,  TRUE, NULL),
('PROYECTO UNTREF',  7, 4,  TRUE, NULL),
('PROYECTO UNTREF',  8, 4, FALSE, NULL),
('PROYECTO UNTREF',  9, 4,  TRUE, NULL),
('PROYECTO UNTREF', 10, 4,  TRUE, NULL),
('PROYECTO UNTREF', 11, 4, FALSE, NULL),
('PROYECTO UNTREF', 12, 4, FALSE, NULL),
('PROYECTO UNTREF', 13, 4,  TRUE, NULL),
('PROYECTO UNTREF', 14, 4,  TRUE, NULL),
('PROYECTO UNTREF', 15, 4, FALSE, NULL),
('PROYECTO UNTREF', 27, 4, FALSE, NULL);