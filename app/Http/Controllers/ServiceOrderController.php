<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Customer;
use App\Models\Device;
use App\Models\ServiceOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ServiceOrderController extends Controller
{
    /**
     * Mostrar todas las órdenes de servicio.
     */
    public function index()
    {
        $serviceOrders = ServiceOrder::with([
            'customer',
            'branch',
            'device',
        ])
            ->latest()
            ->get();

        return view(
            'service_orders.index',
            compact('serviceOrders')
        );
    }

    /**
     * Mostrar formulario para crear una orden.
     */
    public function create()
    {
        $customers = Customer::orderBy('nombre')->get();
        $branches = Branch::orderBy('nombre')->get();

        return view(
            'service_orders.create',
            compact(
                'customers',
                'branches'
            )
        );
    }

    /**
     * Guardar una nueva orden de servicio.
     */
    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDACIÓN
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            // Cliente
            'customer_id' => [
                'required',
                'integer',
                'exists:customers,id',
            ],

            // Sucursal
            'branch_id' => [
                'required',
                'integer',
                'exists:branches,id',
            ],

            // Equipo
            'tipo_equipo' => [
                'required',
                Rule::in([
                    'Celular',
                    'Laptop',
                    'Tablet',
                    'PC',
                ]),
            ],

            'imei_numero_serie' => [
                'nullable',
                'string',
                'max:255',
            ],

            'marca' => [
                'required',
                'string',
                'max:255',
            ],

            'modelo' => [
                'required',
                'string',
                'max:255',
            ],

            'color' => [
                'nullable',
                'string',
                'max:255',
            ],

            // Bloqueo
            'tipo_bloqueo' => [
                'nullable',
                Rule::in([
                    'PIN',
                    'Contraseña',
                    'Patrón',
                ]),
            ],

            'dato_bloqueo' => [
                'nullable',
                'string',
                'max:5000',
            ],

            'tamano_patron' => [
                'nullable',
                Rule::in([
                    '3x3',
                    '4x4',
                ]),
            ],

            'patron_datos' => [
                'nullable',
                'string',
                'max:5000',
            ],

            // Condiciones
            'condiciones_equipo' => [
                'required',
                'string',
            ],

            'accesorios_entregados' => [
                'nullable',
                'string',
            ],

            'estado_general' => [
                'required',
                Rule::in([
                    'Bueno',
                    'Regular',
                    'Malo',
                ]),
            ],

            'observaciones' => [
                'nullable',
                'string',
            ],

            // Servicio
            'problema_reportado' => [
                'required',
                'string',
            ],

            'solucion' => [
                'nullable',
                'string',
            ],

            'revisado_anteriormente' => [
                'required',
                'boolean',
            ],

            'fecha_reparacion_programada' => [
                'nullable',
                'date',
            ],

            'fecha_entrega_prometida' => [
                'nullable',
                'date',
            ],

            'hora_entrega_prometida' => [
                'nullable',
                'date_format:H:i',
            ],

            // Firma
            'firma' => [
                'nullable',
                'string',
            ],

            // Costos
            'tiene_garantia' => [
                'required',
                'boolean',
            ],

            'costo_total' => [
                'required',
                'numeric',
                'min:0',
            ],

            'anticipo' => [
                'nullable',
                'numeric',
                'min:0',
                'lte:costo_total',
            ],
        ], [
            'customer_id.required' =>
                'Debes seleccionar un cliente.',

            'customer_id.exists' =>
                'El cliente seleccionado no existe.',

            'branch_id.required' =>
                'Debes seleccionar una sucursal.',

            'branch_id.exists' =>
                'La sucursal seleccionada no existe.',

            'tipo_equipo.required' =>
                'Debes seleccionar el tipo de equipo.',

            'tipo_equipo.in' =>
                'El tipo de equipo seleccionado no es válido.',

            'marca.required' =>
                'Debes ingresar la marca del equipo.',

            'modelo.required' =>
                'Debes ingresar el modelo del equipo.',

            'condiciones_equipo.required' =>
                'Debes indicar las condiciones del equipo.',

            'estado_general.required' =>
                'Debes seleccionar el estado general del equipo.',

            'problema_reportado.required' =>
                'Debes describir el problema reportado.',

            'revisado_anteriormente.required' =>
                'Debes indicar si el equipo fue revisado anteriormente.',

            'fecha_reparacion_programada.date' =>
                'La fecha de reparación no es válida.',

            'fecha_entrega_prometida.date' =>
                'La fecha de entrega no es válida.',

            'hora_entrega_prometida.date_format' =>
                'La hora de entrega no tiene un formato válido.',

            'tiene_garantia.required' =>
                'Debes indicar si el servicio tiene garantía.',

            'costo_total.required' =>
                'Debes ingresar el costo total.',

            'costo_total.numeric' =>
                'El costo total debe ser un número.',

            'costo_total.min' =>
                'El costo total no puede ser negativo.',

            'anticipo.numeric' =>
                'El anticipo debe ser un número.',

            'anticipo.min' =>
                'El anticipo no puede ser negativo.',

            'anticipo.lte' =>
                'El anticipo no puede ser mayor al costo total.',
        ]);

        /*
        |--------------------------------------------------------------------------
        | PREPARAR DATOS DEL BLOQUEO
        |--------------------------------------------------------------------------
        */

        $tipoBloqueo = $validated['tipo_bloqueo'] ?? null;

        $datoBloqueo = null;

        if ($tipoBloqueo === 'Patrón') {
            $datoBloqueo = $validated['patron_datos'] ?? null;
        } elseif (
            $tipoBloqueo === 'PIN' ||
            $tipoBloqueo === 'Contraseña'
        ) {
            $datoBloqueo = $validated['dato_bloqueo'] ?? null;
        }

        /*
        |--------------------------------------------------------------------------
        | REGISTRAR ORDEN
        |--------------------------------------------------------------------------
        */

        try {
            $serviceOrder = DB::transaction(function () use (
                $validated,
                $tipoBloqueo,
                $datoBloqueo
            ) {
                $serviceOrder = ServiceOrder::create([
                    'customer_id' =>
                        $validated['customer_id'],

                    'branch_id' =>
                        $validated['branch_id'],

                    'estado' =>
                        'recibida',

                    'problema_reportado' =>
                        $validated['problema_reportado'],

                    'solucion' =>
                        $validated['solucion'] ?? null,

                    'revisado_anteriormente' =>
                        (bool) $validated['revisado_anteriormente'],

                    'fecha_reparacion_programada' =>
                        $validated['fecha_reparacion_programada'] ?? null,

                    'fecha_entrega_prometida' =>
                        $validated['fecha_entrega_prometida'] ?? null,

                    'hora_entrega_prometida' =>
                        $validated['hora_entrega_prometida'] ?? null,

                    'tiene_garantia' =>
                        (bool) $validated['tiene_garantia'],

                    'costo_total' =>
                        $validated['costo_total'],

                    'anticipo' =>
                        $validated['anticipo'] ?? 0,

                    'firma' =>
                        $validated['firma'] ?? null,
                ]);

                Device::create([
                    'service_order_id' =>
                        $serviceOrder->id,

                    'tipo_equipo' =>
                        $validated['tipo_equipo'],

                    'imei_numero_serie' =>
                        $validated['imei_numero_serie'] ?? null,

                    'marca' =>
                        $validated['marca'],

                    'modelo' =>
                        $validated['modelo'],

                    'color' =>
                        $validated['color'] ?? null,

                    'tipo_bloqueo' =>
                        $tipoBloqueo,

                    'dato_bloqueo' =>
                        $datoBloqueo,

                    'tamano_patron' =>
                        $validated['tamano_patron'] ?? null,

                    'condiciones_equipo' =>
                        $validated['condiciones_equipo'],

                    'accesorios_entregados' =>
                        $validated['accesorios_entregados'] ?? null,

                    'estado_general' =>
                        $validated['estado_general'],

                    'observaciones' =>
                        $validated['observaciones'] ?? null,
                ]);

                return $serviceOrder;
            });

            return redirect()
                ->route(
                    'service-orders.show',
                    $serviceOrder
                )
                ->with(
                    'success',
                    "La orden de servicio #{$serviceOrder->id} fue registrada correctamente."
                );

        } catch (\Throwable $e) {
            return back()
                ->withInput()
                ->withErrors([
                    'general' =>
                        'No fue posible registrar la orden de servicio. Verifica la información e inténtalo nuevamente.',
                ]);
        }
    }

    /**
     * Mostrar una orden de servicio.
     */
    public function show(ServiceOrder $serviceOrder)
    {
        $serviceOrder->load([
            'customer',
            'branch',
            'device',
        ]);

        return view(
            'service_orders.show',
            compact('serviceOrder')
        );
    }

    /**
     * Mostrar formulario para editar una orden.
     */
    public function edit(ServiceOrder $serviceOrder)
    {
        $customers = Customer::orderBy('nombre')->get();

        $branches = Branch::orderBy('nombre')->get();

        $serviceOrder->load([
            'customer',
            'branch',
            'device',
        ]);

        return view(
            'service_orders.edit',
            compact(
                'serviceOrder',
                'customers',
                'branches'
            )
        );
    }

    /**
     * Actualizar una orden de servicio.
     */
    public function update(
        Request $request,
        ServiceOrder $serviceOrder
    ) {
        /*
        |--------------------------------------------------------------------------
        | VALIDACIÓN
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            // Cliente
            'customer_id' => [
                'required',
                'integer',
                'exists:customers,id',
            ],

            // Sucursal
            'branch_id' => [
                'required',
                'integer',
                'exists:branches,id',
            ],

            // Equipo
            'tipo_equipo' => [
                'required',
                Rule::in([
                    'Celular',
                    'Laptop',
                    'Tablet',
                    'PC',
                ]),
            ],

            'imei_numero_serie' => [
                'nullable',
                'string',
                'max:255',
            ],

            'marca' => [
                'required',
                'string',
                'max:255',
            ],

            'modelo' => [
                'required',
                'string',
                'max:255',
            ],

            'color' => [
                'nullable',
                'string',
                'max:255',
            ],

            // Bloqueo
            'tipo_bloqueo' => [
                'nullable',
                Rule::in([
                    'PIN',
                    'Contraseña',
                    'Patrón',
                ]),
            ],

            'dato_bloqueo' => [
                'nullable',
                'string',
                'max:5000',
            ],

            'tamano_patron' => [
                'nullable',
                Rule::in([
                    '3x3',
                    '4x4',
                ]),
            ],

            'patron_datos' => [
                'nullable',
                'string',
                'max:5000',
            ],

            // Condiciones
            'condiciones_equipo' => [
                'required',
                'string',
            ],

            'accesorios_entregados' => [
                'nullable',
                'string',
            ],

            'estado_general' => [
                'required',
                Rule::in([
                    'Bueno',
                    'Regular',
                    'Malo',
                ]),
            ],

            'observaciones' => [
                'nullable',
                'string',
            ],

            // Servicio
            'problema_reportado' => [
                'required',
                'string',
            ],

            'solucion' => [
                'nullable',
                'string',
            ],

            'revisado_anteriormente' => [
                'required',
                'boolean',
            ],

            'fecha_reparacion_programada' => [
                'nullable',
                'date',
            ],

            'fecha_entrega_prometida' => [
                'nullable',
                'date',
            ],

            'hora_entrega_prometida' => [
                'nullable',
                'date_format:H:i',
            ],

            // Firma
            'firma' => [
                'nullable',
                'string',
            ],

            // Costos
            'tiene_garantia' => [
                'required',
                'boolean',
            ],

            'costo_total' => [
                'required',
                'numeric',
                'min:0',
            ],

            'anticipo' => [
                'nullable',
                'numeric',
                'min:0',
                'lte:costo_total',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | PREPARAR BLOQUEO
        |--------------------------------------------------------------------------
        */

        $tipoBloqueo = $validated['tipo_bloqueo'] ?? null;

        $datoBloqueo = null;

        if ($tipoBloqueo === 'Patrón') {
            $datoBloqueo = $validated['patron_datos'] ?? null;
        } elseif (
            $tipoBloqueo === 'PIN' ||
            $tipoBloqueo === 'Contraseña'
        ) {
            $datoBloqueo = $validated['dato_bloqueo'] ?? null;
        }

        /*
        |--------------------------------------------------------------------------
        | ACTUALIZAR ORDEN Y EQUIPO
        |--------------------------------------------------------------------------
        */

        try {
            DB::transaction(function () use (
                $validated,
                $serviceOrder,
                $tipoBloqueo,
                $datoBloqueo
            ) {

                /*
                |--------------------------------------------------------------------------
                | ACTUALIZAR ORDEN
                |--------------------------------------------------------------------------
                */

                $serviceOrder->update([
                    'customer_id' =>
                        $validated['customer_id'],

                    'branch_id' =>
                        $validated['branch_id'],

                    'problema_reportado' =>
                        $validated['problema_reportado'],

                    'solucion' =>
                        $validated['solucion'] ?? null,

                    'revisado_anteriormente' =>
                        (bool) $validated['revisado_anteriormente'],

                    'fecha_reparacion_programada' =>
                        $validated['fecha_reparacion_programada'] ?? null,

                    'fecha_entrega_prometida' =>
                        $validated['fecha_entrega_prometida'] ?? null,

                    'hora_entrega_prometida' =>
                        $validated['hora_entrega_prometida'] ?? null,

                    'tiene_garantia' =>
                        (bool) $validated['tiene_garantia'],

                    'costo_total' =>
                        $validated['costo_total'],

                    'anticipo' =>
                        $validated['anticipo'] ?? 0,

                    'firma' =>
                        $validated['firma'] ?? null,
                ]);

                /*
                |--------------------------------------------------------------------------
                | ACTUALIZAR EQUIPO
                |--------------------------------------------------------------------------
                */

                $serviceOrder->device()->updateOrCreate(
                    [
                        'service_order_id' =>
                            $serviceOrder->id,
                    ],
                    [
                        'tipo_equipo' =>
                            $validated['tipo_equipo'],

                        'imei_numero_serie' =>
                            $validated['imei_numero_serie'] ?? null,

                        'marca' =>
                            $validated['marca'],

                        'modelo' =>
                            $validated['modelo'],

                        'color' =>
                            $validated['color'] ?? null,

                        'tipo_bloqueo' =>
                            $tipoBloqueo,

                        'dato_bloqueo' =>
                            $datoBloqueo,

                        'tamano_patron' =>
                            $validated['tamano_patron'] ?? null,

                        'condiciones_equipo' =>
                            $validated['condiciones_equipo'],

                        'accesorios_entregados' =>
                            $validated['accesorios_entregados'] ?? null,

                        'estado_general' =>
                            $validated['estado_general'],

                        'observaciones' =>
                            $validated['observaciones'] ?? null,
                    ]
                );
            });

            /*
            |--------------------------------------------------------------------------
            | REGRESAR AL SHOW
            |--------------------------------------------------------------------------
            */

            return redirect()
                ->route(
                    'service-orders.show',
                    $serviceOrder
                )
                ->with(
                    'success',
                    "La orden #{$serviceOrder->id} fue actualizada correctamente."
                );

        } catch (\Throwable $e) {

            return back()
                ->withInput()
                ->withErrors([
                    'general' =>
                        'No fue posible actualizar la orden de servicio. Verifica la información e inténtalo nuevamente.',
                ]);
        }
    }

    /**
     * Eliminar una orden de servicio.
     */
    public function destroy(ServiceOrder $serviceOrder)
    {
        $id = $serviceOrder->id;

        $serviceOrder->delete();

        return redirect()
            ->route('service-orders.index')
            ->with(
                'success',
                "La orden #{$id} fue eliminada correctamente."
            );
    }
}