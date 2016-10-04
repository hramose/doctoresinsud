# Sistema de Diagnóstico y Tratamiento de Chagas

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/d/total.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

### - Funcionalidades pendientes de desarrollar: ###
* Versión imprimible de la Historia Clínica. Acordamos que Rodolfo y Carlos van a preparar un modelo de la información que se debe mostrar en la versión imprimible y cómo se debe mostrar.

### - Nuevas funcionalidades solicitadas: ###
* Funcionalidad de alta, baja y modificación de Tratamientos Etiológicos
* Funcionalidad de alta, baja y modificación de Síntomas
* Funcionalidad de alta, baja y modificación de Patologías
* Agregar los siguientes paneles a la pantalla principal del sistema: últimos pacientes atendidos, próximas citas
* Medicamentos: Droga y familia. Se buscará una base de datos que provea un listado completo para incorporar al sistema. Se verá con Ana la posibilidad de obtener estos datos del ANMAT.
* Índice de Comorbilidad de Charlson: se habló si se puede incluir el cálculo automático de este índice en el sistema. Se dejaría esta funcionalidad para la próxima versión del sistema.
* Se desea utilizar el campo “Fecha de próxima cita” para que el sistema envíe por e-mail y/o por SMS un aviso al paciente unos días antes de la consulta programada. Esta funcionalidad solo será posible si servidor donde se encuentre el sistema tendrá acceso a Internet. 
* Se habló de dar la posibilidad de extraer los datos del sistema en forma masiva para exportar a Excel y luego a un programa de estadísticas. Esto se desarrollará luego de poner en funcionamiento la primer versión del sistema.

### - Cambios solicitados: ###
* Analizar posibilidad de que la unidad de medida maneje fórmula para convertir a otra unidad (se analizará si se puede incluir en la primer versión o si se deja para la próxima versión)
* Creador de Estudios: incorporar funcionalidad para inhabilitar campos para que no se sigan solicitando al dar de alta un nuevo estudio de un paciente, pero se conserven los datos históricos en aquellos que estudios que ya fueron utilizados.
* Se analizará la posibilidad de incluir en esta versión un nuevo tipo de campo para los estudios que permita subir archivos (imágenes, videos, etc) al sistema. Hay que evaluar que esto requerirá más espacio en los discos del servidor, así como también en la solución de backup que se implemente.
* Impedir carga de valor cero en los campos numéricos de los estudios y limpiar los campos que tengan cero hoy en día en la base de datos, para hacer cálculos al realizar estadísticas.
* A la funcionalidad de “consulta” se agregará la opción de seleccionar los síntomas, patologías y eventos registrados en la visita del paciente. 
* Se agregarán los campos para indicar la frecuencia cardíaca y presión del paciente en la consulta. Se le solicitó a Carlos y Rodolfo indicar los nombres de los campos que en FOXPRO hacen referencia a la presión y la frecuencia cardíaca, para importar los datos históricos al nuevo sistema
* Tratamientos: permitir en la consulta modificar o confirmar si sigue con los mismos tratamientos o si se suspende. Se asociarán los tratamientos con la consulta.
* En la consulta, se podrá indicar los estudios solicitados.
* Agregar a la consulta, el campo de fecha de próxima cita.
* Se cambiará el orden en el alta de los datos de un nuevo paciente. Primero se solicitará cargar los datos personales, familiares, socio-económicos y epidemiologia y por último los datos de ingreso de la historia clínica
* Se tabularán los datos de país y provincia, no así la localidad. Y se permitirá igualmente el registro de otro país o provincia que no se encuentre en el listado.
* Grupo Clínico: Se mantendrá un histórico de los cambios de grupo clínico. 
* Los paneles de Tratamiento con BNZ y tratamiento con Nifurtimox se quitarán del formulario de alta del paciente.
* Se separarán en 2 paneles los síntomas y patologías detectados al ingreso.
* Se agregarán los siguientes campos requeridos al alta de paciente:
* * Serología: “serología al ingreso” y “títulos serológicos”
* * ECG: “consignación” y “descripción”
* Quitar campo “3 pruebas serológicas negativas” del alta del paciente
* Al formulario de datos familiares, socio-económicos y epidemiológicos se agregará como requeridos los campos “Escolaridad” y “Nombre de obra social”, con la opción de seleccionar “Desconocido”.
* El campo “altura” del formulario de direcciones del paciente, podrá ingresar texto, para permitir la opción “Sin número (S/N)”.