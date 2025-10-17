<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class IndexController extends Controller
{
    public function index(): Response
    {
        $callCompaniesCount = Company::whereNotIn('status', ['cold'])->count();
        return Inertia::render('Index', [
            'callCompaniesCount' => $callCompaniesCount,
        ]);
    }
}
