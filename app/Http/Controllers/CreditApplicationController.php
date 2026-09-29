<?php

namespace App\Http\Controllers;

use App\Models\CreditApplication;
use App\Models\Customer;
use App\Exports\CreditApplicationsExport;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Throwable;

class CreditApplicationController extends Controller
{
    /**
     * Mostrar el formulario para agregar una solicitud de crédito.
     *
     * Submódulo: Clientes > Aperturar crédito.
     */
    public function create(): View
    {
        $customers = Customer::query()
            ->orderBy('nombre')
            ->orderBy('apellido_paterno')
            ->orderBy('apellido_materno')
            ->get();

        return view(
            'credit_applications.create',
            compact('customers')
        );
    }

    /**
     * Guardar una nueva solicitud de crédito.
     *
     * Submódulo: Clientes > Aperturar crédito.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            // Cliente
            'customer_id' => [
                'required',
                'integer',
                'exists:customers,id',
            ],

            // Datos adicionales
            'tipo_cliente' => [
                'required',
                'in:persona_fisica,persona_moral,empresa',
            ],

            'ocupacion_actividad' => [
                'required',
                'string',
                'max:255',
            ],

            'telefono_trabajo' => [
                'nullable',
                'string',
                'max:20',
            ],

            'referencia_personal' => [
                'nullable',
                'string',
                'max:255',
            ],

            'telefono_referencia' => [
                'nullable',
                'string',
                'max:20',
            ],

            'observaciones_adicionales' => [
                'nullable',
                'string',
                'max:2000',
            ],

            // Monto solicitado
            'cantidad_solicitada' => [
                'required',
                'numeric',
                'min:0.01',
                'max:9999999999.99',
            ],

            'moneda' => [
                'required',
                'in:MXN,USD,EUR',
            ],

            'frecuencia_pago' => [
                'required',
                'in:semanal,quincenal,mensual',
            ],

            'observaciones_monto' => [
                'nullable',
                'string',
                'max:2000',
            ],

            // Documentos requeridos
            'identificacion_oficial' => [
                'required',
                'file',
                'mimes:pdf,jpg,jpeg,png',
                'max:5120',
            ],

            'comprobante_domicilio' => [
                'required',
                'file',
                'mimes:pdf,jpg,jpeg,png',
                'max:5120',
            ],

            'constancia_situacion_fiscal' => [
                'required',
                'file',
                'mimes:pdf,jpg,jpeg,png',
                'max:5120',
            ],
        ], [
            // Cliente
            'customer_id.required' =>
                'Debes seleccionar un cliente.',

            'customer_id.exists' =>
                'El cliente seleccionado no existe.',

            // Datos adicionales
            'tipo_cliente.required' =>
                'Debes seleccionar el tipo de cliente.',

            'tipo_cliente.in' =>
                'El tipo de cliente seleccionado no es válido.',

            'ocupacion_actividad.required' =>
                'La ocupación o actividad económica es obligatoria.',

            'ocupacion_actividad.max' =>
                'La ocupación o actividad económica no debe superar los 255 caracteres.',

            'telefono_trabajo.max' =>
                'El teléfono de trabajo no debe superar los 20 caracteres.',

            'telefono_referencia.max' =>
                'El teléfono de referencia no debe superar los 20 caracteres.',

            'observaciones_adicionales.max' =>
                'Las observaciones adicionales no deben superar los 2000 caracteres.',

            // Monto solicitado
            'cantidad_solicitada.required' =>
                'Debes ingresar la cantidad solicitada.',

            'cantidad_solicitada.numeric' =>
                'La cantidad solicitada debe ser numérica.',

            'cantidad_solicitada.min' =>
                'La cantidad solicitada debe ser mayor a cero.',

            'cantidad_solicitada.max' =>
                'La cantidad solicitada supera el monto permitido.',

            'moneda.required' =>
                'Debes seleccionar una moneda.',

            'moneda.in' =>
                'La moneda seleccionada no es válida.',

            'frecuencia_pago.required' =>
                'Debes seleccionar una frecuencia de pago.',

            'frecuencia_pago.in' =>
                'La frecuencia de pago seleccionada no es válida.',

            'observaciones_monto.max' =>
                'Las observaciones del monto no deben superar los 2000 caracteres.',

            // Documentos
            'identificacion_oficial.required' =>
                'La identificación oficial es obligatoria.',

            'identificacion_oficial.file' =>
                'La identificación oficial debe ser un archivo válido.',

            'identificacion_oficial.mimes' =>
                'La identificación debe ser PDF, JPG, JPEG o PNG.',

            'identificacion_oficial.max' =>
                'La identificación no debe superar los 5 MB.',

            'comprobante_domicilio.required' =>
                'El comprobante de domicilio es obligatorio.',

            'comprobante_domicilio.file' =>
                'El comprobante de domicilio debe ser un archivo válido.',

            'comprobante_domicilio.mimes' =>
                'El comprobante debe ser PDF, JPG, JPEG o PNG.',

            'comprobante_domicilio.max' =>
                'El comprobante no debe superar los 5 MB.',

            'constancia_situacion_fiscal.required' =>
                'La constancia de situación fiscal es obligatoria.',

            'constancia_situacion_fiscal.file' =>
                'La constancia de situación fiscal debe ser un archivo válido.',

            'constancia_situacion_fiscal.mimes' =>
                'La constancia debe ser PDF, JPG, JPEG o PNG.',

            'constancia_situacion_fiscal.max' =>
                'La constancia no debe superar los 5 MB.',
        ]);

        DB::beginTransaction();

        $storedFiles = [];

        try {
            /*
             * Crear la solicitud de crédito.
             */
            $creditApplication = CreditApplication::create([
                'customer_id' => $validated['customer_id'],

                'estado' => 'pendiente',

                'tipo_cliente' => $validated['tipo_cliente'],

                'ocupacion_actividad' =>
                    $validated['ocupacion_actividad'],

                'telefono_trabajo' =>
                    $validated['telefono_trabajo'] ?? null,

                'referencia_personal' =>
                    $validated['referencia_personal'] ?? null,

                'telefono_referencia' =>
                    $validated['telefono_referencia'] ?? null,

                'observaciones_adicionales' =>
                    $validated['observaciones_adicionales'] ?? null,

                'cantidad_solicitada' =>
                    $validated['cantidad_solicitada'],

                'moneda' =>
                    $validated['moneda'],

                'frecuencia_pago' =>
                    $validated['frecuencia_pago'],

                'observaciones_monto' =>
                    $validated['observaciones_monto'] ?? null,
            ]);

            /*
             * Documentos que se deben guardar.
             */
            $documents = [
                [
                    'tipo_documento' => 'identificacion_oficial',
                    'file' => $request->file('identificacion_oficial'),
                ],

                [
                    'tipo_documento' => 'comprobante_domicilio',
                    'file' => $request->file('comprobante_domicilio'),
                ],

                [
                    'tipo_documento' => 'constancia_situacion_fiscal',
                    'file' => $request->file('constancia_situacion_fiscal'),
                ],
            ];

            /*
             * Guardar los documentos relacionados con la solicitud.
             */
            foreach ($documents as $document) {
                $file = $document['file'];

                $path = $file->store(
                    'creditos/' . $creditApplication->id,
                    'public'
                );

                $storedFiles[] = $path;

                $creditApplication->documents()->create([
                    'tipo_documento' => $document['tipo_documento'],
                    'archivo' => $path,
                    'estado' => 'pendiente',
                ]);
            }

            DB::commit();

            return redirect()
                ->route('customers.index')
                ->with(
                    'success',
                    'La solicitud de crédito se registró correctamente.'
                );
        } catch (Throwable $exception) {
            DB::rollBack();

            /*
             * Eliminar los archivos guardados si ocurre un error.
             */
            foreach ($storedFiles as $storedFile) {
                Storage::disk('public')->delete($storedFile);
            }

            report($exception);

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Ocurrió un error al registrar la solicitud de crédito.'
                );
        }
    }

    /**
     * Mostrar el listado de líneas o solicitudes de crédito.
     *
     * Submódulo: Clientes > Líneas de crédito.
     */
    public function index(Request $request): View
    {
        $search = trim(
            (string) $request->input('search', '')
        );

        $period = $request->input('period', 'all');

        $query = CreditApplication::query()
            ->with('customer')
            ->latest();

        /*
         * Búsqueda por cliente, empresa o correo.
         */
        if ($search !== '') {
            $query->whereHas('customer', function ($customerQuery) use ($search) {
                $customerQuery
                    ->where('nombre', 'like', "%{$search}%")
                    ->orWhere('apellido_paterno', 'like', "%{$search}%")
                    ->orWhere('apellido_materno', 'like', "%{$search}%")
                    ->orWhere('empresa', 'like', "%{$search}%")
                    ->orWhere('correo', 'like', "%{$search}%")
                    ->orWhere('telefono', 'like', "%{$search}%");
            });
        }

        /*
         * Filtros de fecha.
         */
        switch ($period) {
            case 'today':
                $query->whereDate(
                    'created_at',
                    now()->toDateString()
                );
                break;

            case 'yesterday':
                $query->whereDate(
                    'created_at',
                    now()->subDay()->toDateString()
                );
                break;

            case 'week':
                $query->whereBetween('created_at', [
                    now()->startOfWeek(),
                    now()->endOfWeek(),
                ]);
                break;

            case 'month':
                $query->whereBetween('created_at', [
                    now()->startOfMonth(),
                    now()->endOfMonth(),
                ]);
                break;

            case 'year':
                $query->whereBetween('created_at', [
                    now()->startOfYear(),
                    now()->endOfYear(),
                ]);
                break;
        }

        $creditApplications = $query
            ->paginate(15)
            ->withQueryString();

        /*
         * La vista index.blade.php utiliza la variable
         * $applications.
         */
        return view(
            'credit_applications.index',
            [
                'applications' => $creditApplications,
                'search' => $search,
                'period' => $period,
            ]
        );
    }

    /**
     * Mostrar el detalle de una solicitud de crédito.
     */
    public function show(
        CreditApplication $creditApplication
    ): View {
        $creditApplication->load([
            'customer',
            'documents',
        ]);

        return view(
            'credit_applications.show',
            compact('creditApplication')
        );
    }

    /**
     * Mostrar el formulario para editar una solicitud de crédito.
     */
    public function edit(
        CreditApplication $creditApplication
    ): View {
        $customers = Customer::query()
            ->orderBy('nombre')
            ->orderBy('apellido_paterno')
            ->orderBy('apellido_materno')
            ->get();

        $creditApplication->load('customer');

        return view(
            'credit_applications.edit',
            compact(
                'creditApplication',
                'customers'
            )
        );
    }

    /**
     * Actualizar una solicitud de crédito.
     */
    public function update(
        Request $request,
        CreditApplication $creditApplication
    ): RedirectResponse {
        $validated = $request->validate([
            // Cliente
            'customer_id' => [
                'required',
                'integer',
                'exists:customers,id',
            ],

            // Estado
            'estado' => [
                'required',
                'in:pendiente,aprobada,rechazada,cancelada',
            ],

            // Datos adicionales
            'tipo_cliente' => [
                'required',
                'in:persona_fisica,persona_moral,empresa',
            ],

            'ocupacion_actividad' => [
                'required',
                'string',
                'max:255',
            ],

            'telefono_trabajo' => [
                'nullable',
                'string',
                'max:20',
            ],

            'referencia_personal' => [
                'nullable',
                'string',
                'max:255',
            ],

            'telefono_referencia' => [
                'nullable',
                'string',
                'max:20',
            ],

            'observaciones_adicionales' => [
                'nullable',
                'string',
                'max:2000',
            ],

            // Monto solicitado
            'cantidad_solicitada' => [
                'required',
                'numeric',
                'min:0.01',
                'max:9999999999.99',
            ],

            'moneda' => [
                'required',
                'in:MXN,USD,EUR',
            ],

            'frecuencia_pago' => [
                'required',
                'in:semanal,quincenal,mensual',
            ],

            'observaciones_monto' => [
                'nullable',
                'string',
                'max:2000',
            ],
        ], [
            'customer_id.required' =>
                'Debes seleccionar un cliente.',

            'customer_id.exists' =>
                'El cliente seleccionado no existe.',

            'estado.required' =>
                'Debes seleccionar el estado de la solicitud.',

            'estado.in' =>
                'El estado seleccionado no es válido.',

            'tipo_cliente.required' =>
                'Debes seleccionar el tipo de cliente.',

            'tipo_cliente.in' =>
                'El tipo de cliente seleccionado no es válido.',

            'ocupacion_actividad.required' =>
                'La ocupación o actividad económica es obligatoria.',

            'ocupacion_actividad.max' =>
                'La ocupación o actividad económica no debe superar los 255 caracteres.',

            'telefono_trabajo.max' =>
                'El teléfono de trabajo no debe superar los 20 caracteres.',

            'telefono_referencia.max' =>
                'El teléfono de referencia no debe superar los 20 caracteres.',

            'observaciones_adicionales.max' =>
                'Las observaciones adicionales no deben superar los 2000 caracteres.',

            'cantidad_solicitada.required' =>
                'Debes ingresar la cantidad solicitada.',

            'cantidad_solicitada.numeric' =>
                'La cantidad solicitada debe ser numérica.',

            'cantidad_solicitada.min' =>
                'La cantidad solicitada debe ser mayor a cero.',

            'cantidad_solicitada.max' =>
                'La cantidad solicitada supera el monto permitido.',

            'moneda.required' =>
                'Debes seleccionar una moneda.',

            'moneda.in' =>
                'La moneda seleccionada no es válida.',

            'frecuencia_pago.required' =>
                'Debes seleccionar una frecuencia de pago.',

            'frecuencia_pago.in' =>
                'La frecuencia de pago seleccionada no es válida.',

            'observaciones_monto.max' =>
                'Las observaciones del monto no deben superar los 2000 caracteres.',
        ]);

        try {
            $creditApplication->update([
                'customer_id' => $validated['customer_id'],

                'estado' => $validated['estado'],

                'tipo_cliente' => $validated['tipo_cliente'],

                'ocupacion_actividad' =>
                    $validated['ocupacion_actividad'],

                'telefono_trabajo' =>
                    $validated['telefono_trabajo'] ?? null,

                'referencia_personal' =>
                    $validated['referencia_personal'] ?? null,

                'telefono_referencia' =>
                    $validated['telefono_referencia'] ?? null,

                'observaciones_adicionales' =>
                    $validated['observaciones_adicionales'] ?? null,

                'cantidad_solicitada' =>
                    $validated['cantidad_solicitada'],

                'moneda' =>
                    $validated['moneda'],

                'frecuencia_pago' =>
                    $validated['frecuencia_pago'],

                'observaciones_monto' =>
                    $validated['observaciones_monto'] ?? null,
            ]);

            return redirect()
                ->route(
                    'credit-applications.show',
                    $creditApplication
                )
                ->with(
                    'success',
                    'La solicitud de crédito se actualizó correctamente.'
                );
        } catch (Throwable $exception) {
            report($exception);

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Ocurrió un error al actualizar la solicitud de crédito.'
                );
        }
    }

    /**
     * Eliminar una solicitud de crédito y sus documentos.
     */
    public function destroy(
        CreditApplication $creditApplication
    ): RedirectResponse {
        DB::beginTransaction();

        try {
            $creditApplication->load('documents');

            /*
             * Eliminar los archivos físicos de los documentos.
             */
            foreach ($creditApplication->documents as $document) {
                if (
                    $document->archivo &&
                    Storage::disk('public')->exists($document->archivo)
                ) {
                    Storage::disk('public')->delete($document->archivo);
                }
            }

            /*
             * Eliminar los registros relacionados.
             */
            $creditApplication->documents()->delete();

            /*
             * Eliminar la solicitud de crédito.
             */
            $creditApplication->delete();

            DB::commit();

            return redirect()
                ->route('credit-applications.index')
                ->with(
                    'success',
                    'La solicitud de crédito se eliminó correctamente.'
                );
        } catch (Throwable $exception) {
            DB::rollBack();

            report($exception);

            return redirect()
                ->route('credit-applications.index')
                ->with(
                    'error',
                    'Ocurrió un error al eliminar la solicitud de crédito.'
                );
        }
    }

    /**
     * Exportar solicitudes de crédito a Excel.
     */
    public function exportExcel(Request $request)
    {
        $search = trim(
            (string) $request->input('search', '')
        );

        $period = $request->input('period', 'all');

        return Excel::download(
            new CreditApplicationsExport($search, $period),
            'lineas_credito.xlsx'
        );
    }

    /**
     * Exportar solicitudes de crédito a PDF.
     */
    public function exportPdf(Request $request)
    {
        $search = trim(
            (string) $request->input('search', '')
        );

        $period = $request->input('period', 'all');

        $query = CreditApplication::query()
            ->with('customer')
            ->latest();

        /*
         * Búsqueda por cliente, empresa o correo.
         */
        if ($search !== '') {
            $query->whereHas('customer', function ($customerQuery) use ($search) {
                $customerQuery
                    ->where('nombre', 'like', "%{$search}%")
                    ->orWhere('apellido_paterno', 'like', "%{$search}%")
                    ->orWhere('apellido_materno', 'like', "%{$search}%")
                    ->orWhere('empresa', 'like', "%{$search}%")
                    ->orWhere('correo', 'like', "%{$search}%")
                    ->orWhere('telefono', 'like', "%{$search}%");
            });
        }

        /*
         * Filtros de fecha.
         */
        switch ($period) {
            case 'today':
                $query->whereDate(
                    'created_at',
                    now()->toDateString()
                );
                break;

            case 'yesterday':
                $query->whereDate(
                    'created_at',
                    now()->subDay()->toDateString()
                );
                break;

            case 'week':
                $query->whereBetween('created_at', [
                    now()->startOfWeek(),
                    now()->endOfWeek(),
                ]);
                break;

            case 'month':
                $query->whereBetween('created_at', [
                    now()->startOfMonth(),
                    now()->endOfMonth(),
                ]);
                break;

            case 'year':
                $query->whereBetween('created_at', [
                    now()->startOfYear(),
                    now()->endOfYear(),
                ]);
                break;
        }

        $creditApplications = $query->get();

        $pdf = Pdf::loadView(
            'credit_applications.pdf',
            compact(
                'creditApplications',
                'search',
                'period'
            )
        );

        $pdf->setPaper('a4', 'landscape');

        return $pdf->download('lineas_credito.pdf');
    }

    /**
     * Mostrar la vista de impresión de solicitudes de crédito.
     */
    public function print(Request $request)
    {
        $search = trim(
            (string) $request->input('search', '')
        );

        $period = $request->input('period', 'all');

        $query = CreditApplication::query()
            ->with('customer')
            ->latest();

        /*
         * Búsqueda por cliente, empresa o correo.
         */
        if ($search !== '') {
            $query->whereHas('customer', function ($customerQuery) use ($search) {
                $customerQuery
                    ->where('nombre', 'like', "%{$search}%")
                    ->orWhere('apellido_paterno', 'like', "%{$search}%")
                    ->orWhere('apellido_materno', 'like', "%{$search}%")
                    ->orWhere('empresa', 'like', "%{$search}%")
                    ->orWhere('correo', 'like', "%{$search}%")
                    ->orWhere('telefono', 'like', "%{$search}%");
            });
        }

        /*
         * Filtros de fecha.
         */
        switch ($period) {
            case 'today':
                $query->whereDate(
                    'created_at',
                    now()->toDateString()
                );
                break;

            case 'yesterday':
                $query->whereDate(
                    'created_at',
                    now()->subDay()->toDateString()
                );
                break;

            case 'week':
                $query->whereBetween('created_at', [
                    now()->startOfWeek(),
                    now()->endOfWeek(),
                ]);
                break;

            case 'month':
                $query->whereBetween('created_at', [
                    now()->startOfMonth(),
                    now()->endOfMonth(),
                ]);
                break;

            case 'year':
                $query->whereBetween('created_at', [
                    now()->startOfYear(),
                    now()->endOfYear(),
                ]);
                break;
        }

        $creditApplications = $query->get();

        return view(
            'credit_applications.print',
            compact(
                'creditApplications',
                'search',
                'period'
            )
        );
    }
}