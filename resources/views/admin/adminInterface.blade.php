@extends('layout.authlayout')

@section('content')

<body class="bg-gradient-to-b from-white to-red-500">

    <span class="fixed text-white text-xl top-5 left-4 cursor-pointer ml-3" onclick="Open()">
        <i class="fa-solid fa-bars-staggered bg-gray-700 p-2 rounded-md"></i>
    </span>

    <div class="flex">

        {{-- sidebar --}}
@include('layout.adminSidebar')


    {{-- SA LOOB NITO YUNG MAIN PAGE --}}
        <div class="content flex-grow p-4 ml-0 duration-1000">

            {{-- STATISTICS PWEDE ILAGAY DITO --}}

            {{-- account wrapper --}}
                <div class="container p-6 bg-white rounded-md mb-10">

                    <div class="grid grid-cols-5 gap-4">

                        <div>
                            <h1>VERIFICATION LIST</h1>
                        </div>

                        <div class="col-span-5 bg-transparent rounded-lg shadow-sm">


                            {{-- list nto --}}
                            @include('admin.landlordVerification')

                            @include('admin.propertyverification')
                            {{--  --}}
                            <div class="container mt-8 mx-auto">

                            </div>
                        </div>
                    </div>
                </div>
            {{-- account wrapper --}}

            {{-- manage wrapper --}}
                <div class="container p-6 bg-white rounded-md">

                    <div class="grid grid-cols-5 gap-4">

                        <div class="col-span-5 bg-whiterounded-lg shadow-sm">

                            <div>
                                <h1>Account Management</h1>
                            </div>

                  @include('admin.adminManageOwner')

                  @include('admin.adminManageProperty')

                  @include('admin.adminManageTenant')

                            {{--  --}}
                            <div class="container mt-8 mx-auto">

                            </div>
                        </div>
                    </div>
                </div>
            {{-- manage wrapper --}}
        </div>

        {{-- script ng smooth scroll --}}
        <script>
            function scrollToElement(elementId) {
                var element = document.getElementById(elementId);
                if (element) {
                    element.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            }
        </script>


    </div>

@endsection

@section('scripts')
    @parent

    @if(session('success'))
        <script>
            alert("{{ session('success') }}");
        </script>
    @endif
    @if(session('error'))
    <script>
        alert("{{ session('error') }}");
    </script>
@endif
@endsection
