<?php

namespace App\Http\Controllers;

use App\Models\Sucursal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tienda;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Comment;

class SucursalController extends Controller
{
    public function viewSaveSucursal($id)
    {
        $user = Auth::user();
        $tienda = Tienda::find($id);
        $favoritos = auth()->user() ? auth()->user()->favoritos : [];
        return view('admin.saveSucursal', compact('user', 'tienda', 'favoritos'));
    }

    public function saveSucursal(Request $request)
    {
        $user = Auth::user();

        // Verificar si el usuario ya tiene una tienda relacionada
        /** @var \App\Models\Tienda $user */
        if (!$user->tiendas()->exists()) {
            return redirect('/profileShop')->with('error', 'Debes tener al menos una tienda para agregar sucursales.');
        }

        $tienda = $user->tiendas; // Obtener la primera tienda del usuario

        $sucursal = new Sucursal([
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'description' => $request->input('description'),
            'assistant' => $request->input('assistant'),
            'schedule' => $request->input('schedule'),
            'location' => $request->input('location'),
            'tienda_id' => $tienda->id // Asociar la sucursal a la tienda
        ]);

        $sucursal->save();

        return redirect('/profileShop')->with('success', 'Sucursal agregada exitosamente.');
    }

    public function deletedSucursal($id)
    {
        $sucursal = Sucursal::find($id);
        $sucursal->delete();
        return redirect('/profileShop')->with('success', 'Sucursal eliminada');
    }

    public function viewUpdateSucursal($id)
    {
        $user = Auth::user();
        $sucursal = Sucursal::find($id);
        $favoritos = auth()->user() ? auth()->user()->favoritos : [];
        return view('admin.editSucursal', compact('user', 'sucursal', 'favoritos'));
    }

    public function updateSucursal(Request $request, $id)
    {
        $sucursal = Sucursal::find($id);

        $sucursal->name = $request->input('name');
        $sucursal->address = $request->input('address');
        $sucursal->description = $request->input('description');
        $sucursal->assistant = $request->input('assistant');
        $sucursal->schedule = $request->input('schedule');
        $sucursal->location = $request->input('location');

        $sucursal->save();

        return redirect('/profileShop')->with('success', 'Sucursal actualizada exitosamente.');
    }

    public function viewStatisticsSucursal(Request $request, $id)
    {
        $selectedMonth = $request->input('month_filter');
        $sucursal = Sucursal::find($id);
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();

        // Establecer la configuración regional a español
        Carbon::setLocale('es');

        $monthlyVisits = DB::table('sucursal_visits')
            ->select(
                DB::raw('CONCAT(' . Carbon::now()->format('"F Y"') . ') as month_year'), // Formatear el mes en español
                DB::raw('MONTH(sucursal_visits.created_at) as month'),
                'sucursal_visits.sucursal_id',
                DB::raw('SUM(sucursal_visits.visit_count) as visit_count')
            )
            ->whereBetween('sucursal_visits.created_at', [$startDate, $endDate])
            ->groupBy('month_year', 'month', 'sucursal_visits.sucursal_id')
            ->orderBy('month_year', 'ASC')
            ->get();

        $weeklyVisits = DB::table('sucursal_visits')
            ->select(
                DB::raw('CONCAT(' . Carbon::now()->format('"F Y"') . ') as month_year'), // Formatear el mes en español
                DB::raw('WEEK(sucursal_visits.created_at) - WEEK(DATE_SUB(sucursal_visits.created_at, INTERVAL DAY(sucursal_visits.created_at)-1 DAY)) + 1 as week_in_month'),
                'sucursal_visits.sucursal_id',
                DB::raw('COALESCE(users.name, "Usuarios no logeados") as user_name'),
                DB::raw('SUM(sucursal_visits.visit_count) as visit_count')
            )
            ->leftJoin('users', 'sucursal_visits.user_id', '=', 'users.id')
            ->whereBetween('sucursal_visits.created_at', [$startDate, $endDate])
            ->groupBy('month_year', 'week_in_month', 'sucursal_visits.sucursal_id', 'users.name')
            ->orderBy('month_year', 'ASC')
            ->orderBy('week_in_month', 'ASC')
            ->get();

        $historicalTotal = DB::table('sucursal_visits')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('visit_count');

        $comments = Comment::where('sucursal_id', $id)->get();

        $count = $comments->where('rating', '!=', null)->count();

        $avgRating = $comments->avg('rating');


            $favoritos = auth()->user() ? auth()->user()->favoritos : [];

        return view('admin.statisticsSucursal', compact('sucursal', 'weeklyVisits', 'historicalTotal', 'count', 'avgRating', 'favoritos','monthlyVisits'));

    }
}
