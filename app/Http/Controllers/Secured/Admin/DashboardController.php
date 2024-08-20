<?php

namespace App\Http\Controllers\Secured\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $activeMenu = 'dashboard';

        $counts = DB::select(" SELECT
            (SELECT COUNT(*) FROM users) as countUser,
            (SELECT COUNT(*) FROM t_requests) as countRequest,
            (SELECT COUNT(*) FROM t_units) as countUnit,
            (SELECT COUNT(*) FROM t_tools) as countTool,
            (SELECT COUNT(*) FROM t_tool_types) as countToolType
        ");

        $counts = $counts[0]; // Since DB::select() returns an array, get the first result

        $countUser = $counts->countUser;
        $countRequest = $counts->countRequest;
        $countUnit = $counts->countUnit;
        $countTool = $counts->countTool;
        $countToolType = $counts->countToolType;
        return view('secured.pages.admin.dashboard',  compact("activeMenu", "countUser", "countRequest", "countUnit", "countTool", "countToolType"));
    }
}
