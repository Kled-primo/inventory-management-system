@extends('layouts.tabler')

@section('content')

<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">
                    Overview
                </div>
                <h2 class="page-title">
                    Year Settings
                </h2>
            </div>
        </div>
    </div>
</div>
<div class="container-xl mt-2">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('settings.save') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="value">Value</label>
                            <input type="text" name="value" class="form-control">
                        </div>
                        <input type="hidden" name="name" value="Forecast Year">
                        <button class="btn btn-success mt-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-floppy" viewBox="0 0 16 16">
                                <path d="M11 2H9v3h2z" />
                                <path d="M1.5 0h11.586a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13A1.5 1.5 0 0 1 1.5 0M1 1.5v13a.5.5 0 0 0 .5.5H2v-4.5A1.5 1.5 0 0 1 3.5 9h9a1.5 1.5 0 0 1 1.5 1.5V15h.5a.5.5 0 0 0 .5-.5V2.914a.5.5 0 0 0-.146-.353l-1.415-1.415A.5.5 0 0 0 13.086 1H13v4.5A1.5 1.5 0 0 1 11.5 7h-7A1.5 1.5 0 0 1 3 5.5V1H1.5a.5.5 0 0 0-.5.5m3 4a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V1H4zM3 15h10v-4.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5z" />
                            </svg>
                            Save
                        </button>

                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Settings
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Setting</th>
                            <th>Value</th>
                            <th></th>
                        </tr>
                        @foreach($settings as $setting)
                        <tr>
                            <td>
                                {{ $setting->name }}
                                @if ($setting->is_active == 1)
                                <span class="badge bg-green text-white">Active
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-checks">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M7 12l5 5l10 -10" />
                                        <path d="M2 12l5 5m5 -5l5 -5" />
                                    </svg>
                                </span>
                                @endif

                            </td>
                            <td>{{ $setting->value }}</td>
                            <td>
                                @if ($setting->is_active == 0)
                                <a href="{{ route('settings.setactive',$setting->id) }}" class="btn btn-sm btn-success"> Set Active</a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
