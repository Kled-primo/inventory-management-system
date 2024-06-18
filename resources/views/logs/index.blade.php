@extends('layouts.tabler')

@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th>Description</th>
                                <th>Subject</th>
                                <th>Changes</th>
                                <th>User</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($activities as $activity)
                        <tr>
                            <td>{{ $activity->description ?? "" }}</td>
                            <td>{{ $activity->subject->name ?? "" }}</td>
                            <td>
                                {{ $activity->changes ?? "" }}
                            </td>
                            <td>{{ $activity->causer->name }}</td>
                            <td>{{ $activity->created_at }}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
