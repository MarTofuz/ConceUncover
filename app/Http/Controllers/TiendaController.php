<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tienda;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TiendaController extends Controller
{
    public function viewSaveShop()
    {
        $user = Auth::user();
        $tiendas = $user->tiendas;
        $favoritos = auth()->user() ? auth()->user()->favoritos : [];
        return view('admin.editShop', compact('user', 'tiendas', 'favoritos'));
    }

    public function saveShop(Request $request)
    {
        $user = Auth::user();

        // Verificar si el usuario ya tiene una tienda relacionada
        /** @var \App\Models\Tienda $user */
        if ($user->tiendas()->exists()) {
            return redirect('/profile')->with('error', 'No puedes agregar más de una tienda.');
        }

        $tienda = new Tienda([
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'description' => $request->input('description'),
            'assistant' => $request->input('assistant'),
            'schedule' => $request->input('schedule'),
            'location' => $request->input('location')
        ]);
        /** @var \App\Models\Tienda $user */
        $user->tiendas()->save($tienda);

        return redirect('/profile')->with('success', 'Tienda agregada exitosamente.');
    }

    public function viewupdateshop()
    {
        $user = Auth::user();
        $tienda = $user->tiendas;
        $favoritos = auth()->user() ? auth()->user()->favoritos : [];
        return view('admin.editLocal', compact('user', 'tienda', 'favoritos'));
    }

    public function updateShop(Request $request)
    {
        $user = Auth::user();
        $tienda = $user->tiendas;
        if (!$tienda) {
            return redirect('/profileShop')->with('error', 'No tienes una tienda para editar.');
        }

        $tienda->name = $request->input('name');
        $tienda->address = $request->input('address');
        $tienda->description = $request->input('description');
        $tienda->assistant = $request->input('assistant');
        $tienda->schedule = $request->input('schedule');
        $tienda->location = $request->input('location');
        $tienda->save();

        return redirect('/profileShop')->with('success', 'Tienda actualizada exitosamente.');
    }

    public function viewProfileShop()
    {
        $user = Auth::user();
        $tienda = $user->tiendas;
        $sucursales = $tienda->sucursales;
        $favoritos = auth()->user() ? auth()->user()->favoritos : [];
        return view('admin.profileShop', compact('user', 'tienda', 'sucursales', 'favoritos'));
    }

    public function viewStatisticsTienda(Request $request, $id)
    {
        $selectedMonth = $request->input('month_filter');
        $tienda = Tienda::find($id);
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();

        // Establecer la configuración regional a español
        Carbon::setLocale('es');

        $monthlyVisits = DB::table('tienda_visits')
            ->select(
                DB::raw('CONCAT(' . Carbon::now()->format('"F Y"') . ') as month_year'),
                DB::raw('MONTH(tienda_visits.created_at) as month'),
                'tienda_visits.tienda_id',
                DB::raw('SUM(tienda_visits.visit_count) as visit_count')
            )
            ->whereBetween('tienda_visits.created_at', [$startDate, $endDate])
            ->groupBy('month_year', 'month', 'tienda_visits.tienda_id')
            ->orderBy('month_year', 'ASC')
            ->get();

        $weeklyVisits = DB::table('tienda_visits')
            ->select(
                DB::raw('CONCAT(' . Carbon::now()->format('"F Y"') . ') as month_year'),
                DB::raw('WEEK(tienda_visits.created_at) - WEEK(DATE_SUB(tienda_visits.created_at, INTERVAL DAY(tienda_visits.created_at)-1 DAY)) + 1 as week_in_month'),
                'tienda_visits.tienda_id',
                DB::raw('COALESCE(users.name, "Usuarios no logeados") as user_name'),
                DB::raw('SUM(tienda_visits.visit_count) as visit_count')
            )
            ->leftJoin('users', 'tienda_visits.user_id', '=', 'users.id')
            ->whereBetween('tienda_visits.created_at', [$startDate, $endDate])
            ->groupBy('month_year', 'week_in_month', 'tienda_visits.tienda_id', 'users.name')
            ->orderBy('month_year', 'ASC')
            ->orderBy('week_in_month', 'ASC')
            ->get();


        $historicalTotal = DB::table('tienda_visits')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('visit_count');


            $comments = Comment::where('tienda_id', $id)->get();

            $count = $comments->where('rating', '!=', null)->count();

            $avgRating = $comments->avg('rating');


            $favoritos = auth()->user() ? auth()->user()->favoritos : [];

        return view('admin.statisticsTienda', compact('tienda', 'weeklyVisits', 'historicalTotal', 'count', 'avgRating', 'favoritos','monthlyVisits'));

    }
}
