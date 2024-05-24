@extends('layouts.tabler')

@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('permissions.create') }}" method="POST">
                    @csrf
                    <div class="row row-cards">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="users">User</label>
                                {{ html()->select('user_id', $users)->class('form-select') }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="roles">Roles</label>
                                {{ html()->select('role',$roles)->class('form-select') }}
                            </div>
                        </div>

                    </div>
                    <button class="btn btn-info mt-2"> Assign Role</button>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Roles</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($userroles as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if (count($user->roles)>0)
                                    <form action="{{ route('permissions.user.remove',$user->id) }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-8">
                                                <select name="role" id="role" required class="form-select">
                                                    @foreach($user->roles as $role)
                                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <button class="btn btn-danger btn-sm" type="submit"> Remove Role</button>
                                            </div>
                                        </div>
                                    </form>
                                    @endif
                                </td>

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