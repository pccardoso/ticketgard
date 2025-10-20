<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use Illuminate\Support\Facades\Auth;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'auth' => [
                'user' => Auth::check() ? [
                    'id' => Auth::user()->id_users,
                    'name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                    "type" => Auth::user()->tipo,
                    "department" => json_decode(Auth::user()->lista_departamento_users),
                    "adm" => Auth::user()->administrador,
                    "res_chamados" => Auth::user()->res_chamados,
                    "vip" => Auth::user()->vip,
                    "token" => Auth::user()->token_firebase,
                ] : null
            ],
        ]);
    }
}
