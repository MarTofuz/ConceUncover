<?php

namespace App\Http\Controllers;

use App\Models\Sucursal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tienda;
use App\Models\Comment;
use App\Models\SucursalVisit;
use Illuminate\Support\Facades\DB;

class StoreClientController extends Controller
{
    public function viewClientTienda($id)
    {
        $tienda = Tienda::find($id);
        $user = Auth::user();

        if (Auth::check()) {
            $user = Auth::user();

            $visit = $tienda->tienda_visits()->where('user_id', $user->id)->first();

            if ($visit) {
                $visit->increment('visit_count');
            } else {
                $tienda->tienda_visits()->create([
                    'user_id' => $user->id,
                    'visit_count' => 1,
                    'tienda_id' => $tienda->id,
                ]);
            }
        } else {
            // Si el usuario no está autenticado, incrementa el contador de visitas sin usuario
            $tienda->tienda_visits()->updateOrInsert(
                ['user_id' => null, 'tienda_id' => $tienda->id], // Condición para encontrar la fila existente
                [
                    'visit_count' => DB::raw('visit_count + 1'),
                    'is_user' => false,
                    'created_at' => now(), // Incluir el campo created_at
                    'updated_at' => now(), // Incluir el campo updated_at
                ] // Datos a actualizar o insertar
            );
        }

        $productos = $tienda->productos;

        $totalVisits = $tienda->tienda_visits->sum('visit_count');

        return view('admin.storeClientTienda', compact('user', 'tienda', 'productos', 'totalVisits'));
    }

    public function commentSave(Request $request, Tienda $tienda)
    {
        $content = $request->input('content');
        $user_id = $request->input('user_id');
        $comment_id = $request->input('comment_id');


        $tienda->comment()->create([
            'content' => $content,
            'user_id' => $user_id,
            'comment_id' => $comment_id // Asegurarse de asignar el ID del usuario
        ]);

        return redirect()->back();
    }

    public function commentRatingTienda(Request $request, Tienda $tienda)
    {
        $content = $request->input('content');
        $user_id = $request->input('user_id');
        $comment_id = $request->input('comment_id');
        $rating = $request->input('rating');


        $tienda->comment()->create([
            'content' => $content,
            'user_id' => $user_id,
            'comment_id' => $comment_id, // Asegurarse de asignar el ID del usuario
            'rating' => $rating
        ]);

        return redirect()->back();
    }

    public function viewClientSucursal($id)
    {
        $sucursal = Sucursal::find($id);
        $user = Auth::user();

        if (Auth::check()) {
            $user = Auth::user();

            // Registra la visita en la nueva tabla o actualiza el contador si ya existe
            $visit = $sucursal->sucursal_visits()->where('user_id', $user->id)->first();

            if ($visit) {
                // Si el usuario ya visitó esta sucursal, incrementa el contador
                $visit->increment('visit_count');
            } else {
                // Si es la primera vez que el usuario visita esta sucursal, crea un nuevo registro
                $sucursal->sucursal_visits()->create([
                    'user_id' => $user->id,
                    'visit_count' => 1,
                    'sucursal_id' => $sucursal->id, // Establece el 'sucursal_id'
                ]);
            }
        } else {
            $sucursal->sucursal_visits()->updateOrInsert(
                ['user_id' => null, 'sucursal_id' => $sucursal->id],
                [
                    'visit_count' => DB::raw('visit_count + 1'),
                    'is_user' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        $productos = $sucursal->productos;

        $totalVisits = $sucursal->sucursal_visits->sum('visit_count');

        return view('admin.storeClientSucursal', compact('user', 'sucursal', 'productos', 'totalVisits'));
    }

    public function commentSaveSucursal(Request $request, Sucursal $sucursal)
    {
        $content = $request->input('content');
        $user_id = $request->input('user_id');
        $comment_id = $request->input('comment_id');


        $sucursal->comment()->create([
            'content' => $content,
            'user_id' => $user_id,
            'comment_id' => $comment_id // Asegurarse de asignar el ID del usuario
        ]);

        return redirect()->back();
    }

    public function commentRatingSucursal(Request $request, Sucursal $sucursal)
    {
        $content = $request->input('content');
        $user_id = $request->input('user_id');
        $comment_id = $request->input('comment_id');
        $rating = $request->input('rating');


        $sucursal->comment()->create([
            'content' => $content,
            'user_id' => $user_id,
            'comment_id' => $comment_id, // Asegurarse de asignar el ID del usuario
            'rating' => $rating
        ]);

        return redirect()->back();
    }
}
