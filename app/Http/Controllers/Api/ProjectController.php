<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Project;

class ProjectController extends Controller
{
    public function index() {

        // $projects = Project::with( 'type', 'technology')->get();
        $projects = Project::with( 'type', 'technology')->paginate(4);
        
        return response()->json([
            'success' => true,
            'projects' => $projects
        ]);
    }
}
