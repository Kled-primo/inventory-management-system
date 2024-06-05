@extends('layouts.tabler')

@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <form method="POST" action="{{ route('forecast.exportgeneral') }}">
                    @csrf
                    <input type="hidden" name="year" value={{ $year }} />
                    <button class="btn btn-success"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-spreadsheet-fill" viewBox="0 0 16 16">
                            <path d="M6 12v-2h3v2z" />
                            <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1M3 9h10v1h-3v2h3v1h-3v2H9v-2H6v2H5v-2H3v-1h2v-2H3z" />
                        </svg> Export</button>
                </form>
            </div>
            <div class="card-body">
                <div class="table-responsive">

                    @include('forecasts._generaltable')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection