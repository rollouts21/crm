<?php

namespace App\Http\Controllers;

use App\Http\Requests\Company\StoreRequest;
use App\Http\Requests\Company\UpdateRequest;
use App\Models\Company;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CompaniesController extends Controller
{
    public function index(Request $request): Response
    {
        $search = (string) $request->input('search', '');
        $status = (string) $request->input('status', '');

        $companiesQuery = Company::query();

        if ($status !== '') {
            $companiesQuery->where('status', $status);
        }

        if ($search !== '') {
            $companiesQuery->where(function ($query) use ($search) {
                $like = '%' . $search . '%';
                $query
                    ->where('name', 'like', $like)
                    ->orWhere('phone', 'like', $like)
                    ->orWhere('address', 'like', $like)
                    ->orWhere('source', 'like', $like)
                    ->orWhere('status', 'like', $like)
                    ->orWhere('worktime', 'like', $like)
                    ->orWhere('description', 'like', $like)
                    ->orWhere('etc', 'like', $like);
            });
        }

        $companies = $companiesQuery
            ->orderByDesc('updated_at')
            ->orderByDesc('created_at')
            ->get();

        return Inertia::render('Companies/Index', [
            'companies' => $companies,
            'filters' => [
                'search' => $search,
                'status' => $status,
            ],
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Companies/Create');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        Company::create($request->validated());
        return redirect()->route('companies.index');
    }

    public function update(UpdateRequest $request, Company $company): RedirectResponse
    {
        $company->update($request->validated());
        $company->refresh();
        return back()->with('success', 'Статус успешно обновлен!');
    }

    public function delete(Company $company): RedirectResponse
    {
        $company->delete();
        return back()->with('success', 'Удалено');
    }
}
