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