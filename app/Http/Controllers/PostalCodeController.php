<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class PostalCodeController extends Controller
{
    /**
     * Consultar información de un código postal de México.
     */
    public function search(string $codigoPostal): JsonResponse
    {
        // Validar que el código postal tenga 5 dígitos.
        if (!preg_match('/^\d{5}$/', $codigoPostal)) {
            return response()->json([
                'success' => false,
                'message' => 'El código postal debe contener exactamente 5 dígitos.',
            ], 422);
        }

        try {
            $response = Http::timeout(10)
                ->acceptJson()
                ->get("https://postali.app/api/v1/mx/cp/{$codigoPostal}");

            if ($response->notFound()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se encontró información para este código postal.',
                ], 404);
            }

            if ($response->failed()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No fue posible consultar el código postal.',
                ], 502);
            }

            $data = $response->json();

            return response()->json([
                'success' => true,
                'data' => $data,
            ]);

        } catch (\Throwable $e) {

            return response()->json([
                'success' => false,
                'message' => 'No se pudo conectar con el servicio de códigos postales.',
            ], 503);
        }
    }
}