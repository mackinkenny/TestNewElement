@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 rounded p-3 bg-white">
            <div class="mb-2 d-flex justify-content-between align-items-center">
                <h3 class="mb-0">Employees</h3>
                <div class="d-flex">
                    <div class="form-group">
                        <label for="sort">Search:</label>
                        <input class="form-control" type="text" name="search" id="search">
                    </div>
                    <div class="form-group ml-4">
                        <label for="sort">Sort by:</label>
                        <select class="form-control" name="sort" id="sort">
                            <option value="name">Name</option>
                            <option value="created_at">Register date</option>
                        </select>
                    </div>
                    <div class="form-group ml-4">
                        <label for="position">Position:</label>
                        <select class="form-control" name="position" id="position">
                            <option value="">Not select</option>
                            @foreach($positions as $position)
                                <option value="{{$position->id}}">{{$position->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group ml-4">
                        <label for="skill">Skill:</label>
                        <select class="form-control" name="skill" id="skill">
                            <option value="">Not select</option>
                            @foreach($skills as $skill)
                                <option value="{{$skill->name}}">{{$skill->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div id="employees"></div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script src="https://pagination.js.org/dist/2.1.4/pagination.min.js"></script>

    <script>
        const search_field = document.querySelector('#search');
        const sort_field = document.querySelector('#sort');
        const position_field = document.querySelector('#position');
        const skill_field = document.querySelector('#skill');

        sort_field.addEventListener('change', setSort);
        position_field.addEventListener('change', setPosition);
        skill_field.addEventListener('change', setSkill);
        search_field.addEventListener('keyup', setSearch);


        let sort = 'name';
        let position = null;
        let skill = null;
        let search = null;
        let typing = null;

        function setSort(code){
            code.target.value == 'none' ? sort = '' : sort = code.target.value;
            console.log(sort, position, skill, search);
            fetchEmployees(sort, position, skill, search)
        }

        function setPosition(code) {
            code.target.value == 'none' ? position = '' : position = code.target.value;

            fetchEmployees(sort, position, skill, search)
        }

        function setSkill(code) {
            code.target.value == 'none' ? skill = '' : skill = code.target.value;

            fetchEmployees(sort, position, skill, search)
        }

        function setSearch(code) {
            code.target.value == 'none' ? search = '' : search = code.target.value;

            fetchEmployees(sort, position, skill, search)
        }

        function fetchEmployees(sort, position, skill, search) {
            $.ajax({
                url: '{{ route('users/filter') }}',
                data: {
                    sort: sort,
                    position: position,
                    skill: skill,
                    search: search,
                },
                success: data => {
                    let result = $('#employees').hide().html(data.html).fadeIn('fast');
                },
                error: () => {
                }
            })
        }
        fetchEmployees(sort, position, skill, search);
    </script>
@endpush
