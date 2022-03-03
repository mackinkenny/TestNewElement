@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 rounded p-3 bg-white">
                <div class="d-flex justify-content-between mb-2">
                    <h3 class="mb-0">Positions</h3>
                    <a class="bg-success py-1 px-3 rounded text-white border-0" href="{{route('positions/create')}}">
                        Create new
                    </a>
                </div>
                <table class="w-100">
                    <thead class="list-header">
                    <tr class="border-bottom">
                        <th>
                            <div class="py-2 px-2 text-left text-uppercase font-weight-normal">
                                <span class="ml-3">Name</span>
                            </div>
                        </th>
                        <th>
                            <div class="py-2 px-2 text-right text-uppercase font-weight-normal">
                                <span class="ml-3">Action</span>
                            </div>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($positions as $position)
                        <tr class="border-bottom">
                            <td>
                                <div class="py-2 px-2">
                                    <span class="ml-3">{{$position->name}}</span>
                                </div>
                            </td>
                            <td class="text-right px-2">
                                <a class="" href="{{ route('positions/edit', $position->id) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
