@extends('layouts.tabler')

@section('content')
<div class="page-body">
    <div class="container-xl">
    <table class="table table-sm">
        <tr>
            <th>Description</th>
            <th>Subject</th>
            <th>Changes</th>
        </tr>
        @foreach($activies as $activity)
        <tr>
            <td>{{ $activity->description }}</td>
            <td>{{ $activity->subject }}</td>
            <td>{{ $activity->changes }}</td>
        </tr>
        @endforeach
    </table>
    </div>
</div>
@endsection
