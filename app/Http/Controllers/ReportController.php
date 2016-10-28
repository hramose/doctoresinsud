<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Doctrine\DBAL\Schema\Column;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tables = DB::select('SHOW TABLES');

        $hide_tables = ['categories', 'comments', 'dbf_eco', 'dbf_epidemio',
            'dbf_ergometria', 'dbf_lab', 'dbf_pacientes', 'category_post',
            'dbf_tratamientos', 'posts', 'role_user', 'roles', 'migrations',
            'password_resets', 'permission_role', 'permissions', 'paciente_user',
            'users', 'telefonos', 'tickets', 'tipo_datos'];

        $hide_fields = ['created_at', 'updated_at', 'id'];

        return view('reportes.reporte-ui', compact('tables', 'hide_tables', 'hide_fields'));
    }
}
