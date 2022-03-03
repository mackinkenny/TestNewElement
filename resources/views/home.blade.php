@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 rounded p-3 bg-white">
            <table class="w-100">
                <thead class="list-header">
                <tr class="border-bottom">
                    <th>
                        <div class="py-2 px-2 text-left text-uppercase font-weight-normal">
                            <span class="ml-3">Name</span>
                        </div>
                    </th>
                    @auth
                    <th>
                        <div class="py-2 px-2 text-left text-uppercase font-weight-normal">
                            <span class="ml-3">Email</span>
                        </div>
                    </th>
                    <th>
                        <div class="py-2 px-2 text-left text-uppercase font-weight-normal">
                            <span class="ml-3">Phone</span>
                        </div>
                    </th>
                    @endauth
                    <th>
                        <div class="py-2 px-2 text-left text-uppercase font-weight-normal">
                            <span class="ml-3">Position</span>
                        </div>
                    </th>
                    <th>
                        <div class="py-2 px-2 text-left text-uppercase font-weight-normal">
                            <span class="ml-3">Skills</span>
                        </div>
                    </th>
                    @if(Auth::check() && Auth::user()->role->name == 'Admin')
                        <th>
                            <div class="py-2 px-2 text-left text-uppercase font-weight-normal">
                                <span class="ml-3">Action</span>
                            </div>
                        </th>
                    @endif
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr class="border-bottom">
                        <td>
                            <div class="py-2 px-2">
                                <svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="user" width="20" height="20"
                                     class="svg-inline--fa fa-user fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                    <path fill="currentColor"
                                          d="M313.6 304c-28.7 0-42.5 16-89.6 16-47.1 0-60.8-16-89.6-16C60.2 304 0 364.2 0 438.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-25.6c0-74.2-60.2-134.4-134.4-134.4zM400 464H48v-25.6c0-47.6 38.8-86.4 86.4-86.4 14.6 0 38.3 16 89.6 16 51.7 0 74.9-16 89.6-16 47.6 0 86.4 38.8 86.4 86.4V464zM224 288c79.5 0 144-64.5 144-144S303.5 0 224 0 80 64.5 80 144s64.5 144 144 144zm0-240c52.9 0 96 43.1 96 96s-43.1 96-96 96-96-43.1-96-96 43.1-96 96-96z"></path>
                                </svg>
                                <span class="ml-3">{{$user->name}}</span>
                            </div>
                        </td>
                        @auth
                        <td>
                            <div class="py-2 px-2">
                                <span class="ml-3">{{$user->email}}</span>
                            </div>
                        </td>
                        <td>
                            <div class="py-2 px-2">
                                <span class="ml-3">{{$user->phone}}</span>
                            </div>
                        </td>
                        @endauth
                        <td>
                            <div class="py-2 px-2">
                                <span class="ml-3">{{$user->position ? $user->position->name : ''}}</span>
                            </div>
                        </td>
                        <td>
                            @if($user->skills)
                                <div class="py-2 px-2">
                                @foreach($user->skills as $skill)
                                    <span class="ml-3">{{$skill->name}}</span>
                                @endforeach
                                </div>
                            @endif
                        </td>
                        @if(Auth::check() && Auth::user()->role->name == 'Admin')
                            <td class="text-center">
                                <a class="" href="{{ route('users/edit', $user->id) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="none" viewBox="0 0 24 24"
                                         stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                            </td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
