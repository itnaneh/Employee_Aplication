<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EMPLOYEE CRUD</title>
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="bg-dark py-3">
        <div class="container">
            <div class="h4 text-white text-center">EMPLOYEE CRUD</div>
        </div>
    </div>

    <div class="container py-3">
        <div class="d-flex justify-content-between py-3">
            <div class="h4">Employees</div>
            <div>
                <a href="{{ route('employees.create')}}" class="btn btn-primary">Create</a>
            </div>
        </div>
        @if(Session::has('success'))
        <div class="alert alert-success">
                {{Session::get('success')}}
        </div>
        @endif
        <div class="card border-0 shadow-lg">
            <div class="card-body">
                <table class="table table-striped table-bordered table-hover">
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>

                    @if($employees->isNotEmpty())
                    @foreach ($employees as $employee)
                    <tr valign="middle">
                        <td>{{ $employee->id }}</td>
                        <td>
                            @if($employee->image != '' && file_exists(public_path().'/uploads/employees/'.$employee->image))
                            <img src="{{ url('uploads/employees/'.$employee->image) }}" alt="" width="40" height="40" class="rounded-circle">
                            @else
                            <img src="{{ url('assets/images/no-image.png') }}" alt="" width="40" height="40" class="rounded-circle">
                            @endif
                        </td>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->address }}</td>
                        <td>
                            <a href="{{ route('employees.edit',$employee->id) }}" class="btn btn-primary btn-sm m-2"><i class="fa-solid fa-pen-to-square" ></i></a>
                            <a href="#" onclick="deleteEmployee({{ $employee->id }})" class="btn btn-danger btn-sm m-2"> <i class="fa-solid fa-user-minus"></i></a>

                            <form id="employee-edit-action-{{ $employee->id }}" action="{{ route('employees.destroy',$employee->id) }}" method="post">
                                @csrf
                                @method('delete')
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @else
                        <tr>
                            <td colspan="6">Record Not Found</td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>
        <div class="mt-3">
            {{$employees->links()}}
        </div>
    </div>
    
</body>
</html>
<script>
    function deleteEmployee(id) {
        if (confirm("Are you sure you want to delete?")) {
            document.getElementById('employee-edit-action-'+id).submit();
        }
    }
</script>